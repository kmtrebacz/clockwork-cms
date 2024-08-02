<?php

require_once __DIR__ . '/BaseController.php';

class DashboardController extends BaseController {

    public function __construct() {
        parent::__construct();
    }

    public function render(): void {
        $this->renderTemplate('/pages/dashboard.twig', [
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
