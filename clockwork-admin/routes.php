<?php

namespace Admin;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/Controllers/DashboardController.php';
require_once __DIR__ . '/Controllers/PagesController.php';
require_once __DIR__ . '/Controllers/AuthController.php';
require_once __DIR__ . '/Middlewares/AuthMiddleware.php';
require_once __DIR__ . '/Services/PagesServices.php';

use Admin\Controllers\DashboardController;
use Admin\Controllers\PagesController;
use Admin\Controllers\AuthController;
use Admin\Handlers\ErrorHandler;
use Admin\Middlewares\AuthMiddleware;
use Admin\Services\PagesServices;
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::group(['prefix' => '/clockwork-admin'], function () {
     SimpleRouter::get('/', function () {
          header('Location: /clockwork-admin/dashboard');
     });

    SimpleRouter::group([
        'middleware' => AuthMiddleware::class,
        'exceptionHandler' => ErrorHandler::class
    ],function () {
        SimpleRouter::get('/dashboard', [DashboardController::class, 'render']);
        SimpleRouter::get('/pages', [PagesController::class, 'render']);
        SimpleRouter::post('/pages/rename', [PagesServices::class, 'renameFile']);
    });

    SimpleRouter::get('/log-in', [AuthController::class, 'login']);
    SimpleRouter::post('/log-in', [AuthController::class, 'handleLogin']);
    SimpleRouter::get('/sign-up', [AuthController::class, 'signup']);
    SimpleRouter::post('/sign-up', [AuthController::class, 'handleSignup']);
    SimpleRouter::get('/log-out', [AuthController::class, 'logout']);
});
