<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ContactController;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Core\Application;

$app = new Application(dirname(__DIR__));

//home page
$app->router->get('/', [HomeController::class, 'index']);

//auth routes
$app->router->get('/auth/login', [AuthController::class, 'login']);
$app->router->post('/auth/login', [AuthController::class, 'login']);

$app->router->get('/auth/register', [AuthController::class, 'register']);
$app->router->post('/auth/register', [AuthController::class, 'register']);

$app->router->get('/contact', [ContactController::class, 'index']);
$app->router->post('/contact', [ContactController::class, 'store']);

$app->run();
