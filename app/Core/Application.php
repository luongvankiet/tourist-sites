<?php

namespace App\Core;

use App\Controllers\Controller;
use App\Core\Database;
use App\Models\User;

class Application
{
    public static string $ROOT_DIR;
    public static string $APP_URL;
    public static string $APP_BASE_NAME;
    public static string $ASSET_PATH;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Database $db;
    public ?User $authenticatedUser = null;
    public Session $session;
    public static $env;

    public function __construct($rootPath, array $env) {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($env);
        $this->controller = new Controller();
        self::$env = $env;

        self::$APP_URL = $env['APP_URL'] ?? '';
        self::$APP_BASE_NAME = $env['APP_BASE_NAME'] ?? '';
        self::$ASSET_PATH = self::$APP_URL . '/resources/assets' ?? '';

        $primaryKey = $this->session->get('user');
        if ($primaryKey) {
            $this->setAuthenticatedUser(User::getInstance()->find(['id' => $primaryKey]) ?? null);
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function setAuthenticatedUser(?User $user = null)
    {
        if (!$user) {
            return;
        }

        $this->authenticatedUser = $user;
        $primaryKey = $user->getPrimaryKey();
        $this->session->set('user', $user->{$primaryKey});
    }

    public static function dd($value)
    {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
        exit;
    }
}
