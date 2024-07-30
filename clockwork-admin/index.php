<?php

require_once "header.php";

$template = $twig->load("base.twig");
print($template->render([
    "title" => "test",
    "nav" => true,
]));
