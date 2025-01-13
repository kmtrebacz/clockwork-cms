<?php

namespace Admin\Controllers;

require_once __DIR__ . "/../Handlers/ErrorHandler.php";
require_once __DIR__ . "/../Database/DatabaseConnection.php";

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Admin\Database\DatabaseConnection;
use Admin\Handlers\ErrorHandler;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class BaseController {
    protected $twig;
    protected $db;
    protected $errorController;

    public function __construct()
    {
        $this->twig = $this->initializeTwig();
        $this->db = $this->connectDatabase();
        $this->errorController = new ErrorHandler();
    }

    private function initializeTwig(): Environment
    {
         $loader = new FilesystemLoader(__DIR__ . '/../templates');
        $twig = new Environment($loader, [
            'cache' => __DIR__ . '/../storage/cache/twig',
            'debug' => true,
        ]);

        $twig->addFunction(new TwigFunction("csrf_token", function () {
            return csrf_token();
        }));

        return $twig;
    }

    private function connectDatabase(): DatabaseConnection
    {
        $config = require __DIR__ . '/../config.php';
        $db = new DatabaseConnection($config);
        $db->connect();
        return $db;
    }

    protected function renderTemplate(string $templatePath, array $data): void
    {
         try {
               session_start();
               $data['user_name'] = $_SESSION['user_name'];

               $template = $this->twig->load($templatePath);
               echo $template->render($data);
        } catch (LoaderError|RuntimeError|SyntaxError $e) {
               echo 'An error occurred while loading the template: ' . $e->getMessage();
        }
    }
}
