<?php

namespace Admin\Handlers;

class AuthErrorHandler
{
    public function redirectWithError(string $url, string $message): void
    {
        $slug = str_replace(' ', '-', strtolower($message));
        header("Location: $url?error=$slug");
        exit();
    }

    public function getError(): string|null
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["error"]) && $_GET["error"] != '')
            return $_GET["error"];
        return null;
    }
}