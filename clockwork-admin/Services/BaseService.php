<?php

namespace Admin\Services;

require_once __DIR__ . "/../Handlers/ErrorHandler.php";

use Admin\Handlers\ErrorHandler;

class BaseService
{
    protected $errorController;

    public function __construct() {
        $this->errorController = new ErrorHandler();
    }
}