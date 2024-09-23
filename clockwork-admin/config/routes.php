<?php

require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/PageController.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../services/PagesServices.php';
require_once __DIR__ . '/../db/DatabaseConnection.php';
require_once __DIR__ . '/../router/Router.php';

$router = new Router();

$router->get('/clockwork-admin/', function() {
    header('Location: /clockwork-admin/dashboard');
});

$router->get('/clockwork-admin/dashboard', function() {
    $authMiddleware = new AuthMiddleware();
    $authMiddleware->handle();

    $dashboardController = new DashboardController();
    $dashboardController->render();
});


$router->get('/clockwork-admin/pages', function() {
    $authMiddleware = new AuthMiddleware();
    $authMiddleware->handle();

    $pagesController = new PagesController();
    $pagesController->render();
});

$router->get('/clockwork-admin/log-in', function() {
    $authController = new AuthController();
    $authController->login();
});

$router->post('/clockwork-admin/log-in', function() {
    $authController = new AuthController();
    $authController->handleLogin();
});

$router->get('/clockwork-admin/sign-up', function() {
    $authController = new AuthController();
    $authController->signup();
});

$router->post('/clockwork-admin/sign-up', function() {
    $authController = new AuthController();
    $authController->handleSignup();
});

$router->get('/clockwork-admin/log-out', function() {
    $authController = new AuthController();
    $authController->logout();
});

$router->post('/clockwork-admin/rename-file', function() {
     $PagesServices = new PagesServices();
     $PagesServices->renameFile();
});

$router->dispatch();
