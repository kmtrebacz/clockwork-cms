<?php

require_once "header.inc.php";

$template = $twig->load("base.twig");
print($template->render([
    "title" => "test",
    "nav" => true,
]));
