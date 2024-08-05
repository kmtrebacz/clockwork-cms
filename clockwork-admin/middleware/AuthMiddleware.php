<?php

class AuthMiddleware
{
    public function handle()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    }
}
