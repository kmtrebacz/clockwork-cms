<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BaseController
{
    protected $twig;

    public function __construct()
    {
        $this->twig = $this->initializeTwig();
    }

    private function initializeTwig(): Environment
    {
        return require __DIR__ . '/../config/twig.php';
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
}

