<?php

namespace Admin;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/Controllers/DashboardController.php';
require_once __DIR__ . '/Controllers/PagesController.php';
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Middlewares/AuthMiddleware.php';

use Admin\Controllers\DashboardController;
use Admin\Controllers\PagesController;
use Admin\Controllers\AuthController;
use Admin\Handlers\ErrorHandler;
use Admin\Middlewares\AuthMiddleware;
use Pecee\SimpleRouter\SimpleRouter;
use Twig\Error\Error;

SimpleRouter::get('/clockwork-admin/', function () {
    header('Location: /clockwork-admin/dashboard');
});

SimpleRouter::group([
    'middleware' => AuthMiddleware::class,
    'exceptionHandler' => ErrorHandler::class
],function () {
    SimpleRouter::get('/clockwork-admin/dashboard', [DashboardController::class, 'render']);
    SimpleRouter::get('/clockwork-admin/pages', [PagesController::class, 'render']);
});

SimpleRouter::get('/clockwork-admin/log-in', [AuthController::class, 'login']);
SimpleRouter::post('/clockwork-admin/log-in', [AuthController::class, 'handleLogin']);
SimpleRouter::get('/clockwork-admin/sign-up', [AuthController::class, 'signup']);
SimpleRouter::post('/clockwork-admin/sign-up', [AuthController::class, 'handleSignup']);
SimpleRouter::get('/clockwork-admin/log-out', [AuthController::class, 'logout']);
