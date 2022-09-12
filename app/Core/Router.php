<?php

namespace App\Core;

class Router
{
    protected array $routes = [];
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get']['/'. Application::$APP_BASE_NAME . $path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post']['/'. Application::$APP_BASE_NAME . $path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView('404');
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            Application::$app->setController(new $callback[0]());
            $callback[0] = Application::$app->getController();
        }

        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        if (strpos($view, '.')) {
            $view = implode('/', explode('.', $view));
        }

        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        $content = str_replace("@yield('content')", $viewContent, $layoutContent);

        return $content;
    }

    public function renderViewContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace("@yield('content')", $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = Application::$app->getController()->layout;

        if (strpos($layout, '.')) {
            $layout = implode('/', explode('.', $layout));
        }

        ob_start();
        include_once Application::$ROOT_DIR . '/resources/views/' . $layout . '.php';
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = [])
    {
        foreach ($params as $key => $value) {
            ${$key} = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . '/resources/views/' . $view . '.php';
        return ob_get_clean();
    }
}
