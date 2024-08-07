<?php

require_once __DIR__ . '/../controllers/DashboardController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../db/DatabaseConnection.php';
require_once __DIR__ . '/../router/Router.php';

$router = new Router();

$router->get('/clockwork-admin/', function() {
    header('Location: /clockwork-admin/dashboard');
});

$router->get('/clockwork-admin/dashboard', function() {
    $dashboardController = new DashboardController();
    $dashboardController->render();
});

$router->get('/clockwork-admin/log-in', function() {
    $authController = new AuthController();
    $authController->login();
});

$router->get('/clockwork-admin/sign-up', function() {
    $authController = new AuthController();
    $authController->signup();
});

$router->dispatch();
