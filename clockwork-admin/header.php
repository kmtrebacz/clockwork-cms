<?php

define('ROOT_DIR', $_SERVER["DOCUMENT_ROOT"] . '/');

require_once ROOT_DIR . "clockwork-admin/db/Database.php";
require_once ROOT_DIR . 'vendor/autoload.php';


$Database = new Database("127.0.0.1", "root", "root", "cw");
$Database->connect();

$loader = new \Twig\Loader\FilesystemLoader(ROOT_DIR . "templates/");
$twig = new \Twig\Environment($loader, [
     "cache" => ROOT_DIR . "cache/",
]);
