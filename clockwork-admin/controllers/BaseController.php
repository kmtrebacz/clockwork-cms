<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BaseController
{
    protected $twig;
    protected $db;

    public function __construct()
    {
        $this->twig = $this->initializeTwig();
        $this->db = $this->connectDatabase();
    }

    private function initializeTwig(): Environment
    {
        return require __DIR__ . '/../config/twig.php';
    }

    private function connectDatabase(): DatabaseConnection
    {
        $config = require __DIR__ . '/../config/config.php';
        $db = new DatabaseConnection($config);
        $db->connect();
        return $db;
    }

    protected function renderTemplate(string $templatePath, array $data): void
    {
        try {
            $template = $this->twig->load($templatePath);
            echo $template->render($data);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
            echo 'An error occurred while loading the template: ' . $e->getMessage();
        }
    }

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

