<?php

namespace Admin\Controllers;

require_once __DIR__ . '/../Controllers/BaseController.php';
require_once __DIR__ . '/../Handlers/AuthErrorHandler.php';

use Admin\Controllers\BaseController;
use Admin\Handlers\AuthErrorHandler;

class AuthController extends BaseController {
    public function __construct() {
        parent::__construct();
        $this->errorController = new AuthErrorHandler();
    }

    public function login(): void {
        if ($this->anyUsersExist() || defined($_SESSION["user_id"])) {
             $this->renderTemplate('/pages/log-in.twig', [
                  "error" => $this->errorController->getError(),
             ]);
        }
        else
            header('Location: /clockwork-admin/sign-up');
    }

     public function handleLogin(): void {
          $username = $_POST['username'];
          $password = $_POST['password'];

          if ($username == '' or $username == null)
               $this->errorController->getError()("/log-in", "Username input is empty!");

          if ($password == '' or $password == null)
               $this->errorController->redirectWithError("/log-in", "Password input is empty!");


          if ($this->validateLogin($username, $password)) {
               session_start();
               $_SESSION['user_id'] = $this->getUserId($username);
               header('Location: dashboard');
               exit();
          } else {
               $this->errorController->redirectWithError("log-in", "Wrong password or username");
          }
     }


    public function signup(): void {
         $this->renderTemplate('/pages/sign-up.twig', [
              "error" => $this->errorController->getError(),
         ]);
    }

    public function handleSignup(): void {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_repeat'];

        if ($username == '' or $username == null)
             $this->errorController->redirectWithError("/sign-up", "Username input is empty!");

        if ($password == '' or $password == null)
             $this->errorController->redirectWithError("/sign-up", "Password input is empty!");

        if ($passwordRepeat == '' or $passwordRepeat == null)
             $this->errorController->redirectWithError("/sign-up", "Repeated password input is empty!");


        if ($this->isUsernameTaken($username))
             $this->errorController->redirectWithError("/sign-up", "User already exists.");

        if ($password !== $passwordRepeat)
             $this->errorController->redirectWithError("/sign-up", "Passwords do not match.");

        $this->addUserToDB($username, $password);
        header('Location: /log-in');
        exit();
    }


    public function logout(): void {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /clockwork-admin/log-in');
        exit();
    }


    private function anyUsersExist(): bool {
         $result = $this->db->query('SELECT COUNT(*) as count FROM users',returningArray: True);
         return $result["count"] > 0;
    }

    private function validateLogin($username, $password): bool {
        $result = $this->db->query('SELECT password FROM users WHERE username = ?', [$username]);
        if ($result && password_verify($password, $result[0]['password'])) {
            return true;
        }
        return false;
    }

    private function addUserToDB($username, $password): ?array {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        return $this->db->query('INSERT INTO users (username, password) VALUES (?, ?)', [$username, $hashedPassword]);
    }

    private function getUserId($username) {
        $result = $this->db->query('SELECT rowid FROM users WHERE username = ?', [$username]);
        return $result ? $result[0]['rowid'] : null;
    }

    private function isUsernameTaken($username): bool {
         $result = $this->db->query("SELECT COUNT(*) as count FROM users WHERE username = ?", [$username]);
         return $result[0]["count"] > 0;
    }
}
