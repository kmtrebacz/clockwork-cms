<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/routes.php';

use Pecee\SimpleRouter\SimpleRouter;

echo SimpleRouter::start();
