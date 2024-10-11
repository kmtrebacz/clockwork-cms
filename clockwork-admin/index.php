<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once './../vendor/autoload.php';
require_once './routes.php';
require_once './helpers.php';

use Pecee\SimpleRouter\SimpleRouter;

echo SimpleRouter::start();