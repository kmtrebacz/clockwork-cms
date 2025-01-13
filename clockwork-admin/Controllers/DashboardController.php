<?php

namespace Admin\Controllers;

require_once __DIR__ . '/../Controllers/BaseController.php';

use Admin\Controllers\BaseController;

class DashboardController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function render(): void {
         $this->renderTemplate('/pages/dashboard.twig', [
            'error' => $_GET['error'] ?? null,
            'message' => $_GET['message'] ?? null,
            'activeNavItem' => 'Dashboard',
            'nav' => true,
            'cards' => [
                [
                    'heading' => 'Welcome to the Dashboard',
                    'content' => '<p>This is your dashboard where you can manage your site.</p>',
                ],
            ],
        ]);
    }
}
