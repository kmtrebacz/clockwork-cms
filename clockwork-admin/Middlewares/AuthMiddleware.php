<?php

namespace Admin\Middlewares;

use Pecee\Http\Middleware\IMiddleware;

class AuthMiddleware implements IMiddleware
{
    public function handle(Request|\Pecee\Http\Request $request): void
    {

        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /clockwork-admin/log-in');
            exit();
        }
    }
}
