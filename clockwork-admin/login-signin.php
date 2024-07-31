<?php

define('ROOT_DIR', $_SERVER["DOCUMENT_ROOT"] . '/');

require_once ROOT_DIR . "clockwork-admin/db/Database.php";
require_once ROOT_DIR . 'vendor/autoload.php';


function getNumberOfUsers(): int {
    global $Database;

    $numberOfUsersDbResult = $Database->query("SELECT COUNT(users.id) AS number_of_users FROM users;", returningArray: true);
    $numberOfUsers = $numberOfUsersDbResult['number_of_users'];

    return $numberOfUsers;
}

$Database = new Database("localhost", "root", "root", "cw");
$Database->connect();

$loader = new \Twig\Loader\FilesystemLoader(ROOT_DIR . "clockwork-admin/templates/");
$twig = new \Twig\Environment($loader, [
    "cache" => ROOT_DIR . "clockwork-admin/cache/",
]);

$template = $twig->load("login-signin.twig");
print($template->render([
    "admin_exsists" => getNumberOfUsers() > 0,
]));

