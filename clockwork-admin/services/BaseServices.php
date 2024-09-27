<?php

require_once __DIR__ . "/../controllers/ErrorController.php";

class BaseServices {
     protected $errorController;

     public function __construct()
     {
         $this->errorController = new ErrorController();
     }
}
