<?php

require_once __DIR__ . '/BaseController.php';

class AuthController extends BaseController {
    public function __construct() {
        parent::__construct();
    }

    public function login(): void {
        if ($this->anyUsersExist()) {
            $this->renderTemplate('/pages/log-in.twig', []);
        }
        else
            header('Location: /clockwork-admin/sign-up');
    }

    public function signup(): void {
        $this->renderTemplate('/pages/sign-up.twig', []);
    }

    public function handleLogin(): void {
        $username = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->validateLogin($username, $password)) {
            session_start();
            $_SESSION['user_id'] = $this->getUserId($username); // Store user ID in session
            header('Location: /dashboard');
            exit();
        } else {
            header('Location: /login');
            exit();
        }
    }

    public function handleSignup(): void {
        $username = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordRepeat = $_POST['password_repeat'] ?? '';

        if ($this->isUsernameTaken($username)) {
            echo "Error: User already exists.";
            return;
        }

        if ($password !== $passwordRepeat) {
            echo "Passwords do not match.";
        }

        if ($this->addUserToDB($username, $password)) {
            header('Location: /log-in');
            exit();
        } else {
            echo "Error: User registration failed.";
        }
    }

    private function anyUsersExist(): bool {
        $result = $this->db->query('SELECT COUNT(*) as count FROM users');
        return $result[0]['count'] > 0;
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
        $result = $this->db->query('SELECT id FROM users WHERE username = ?', [$username]);
        return $result ? $result[0]['id'] : null;
    }

    private function isUsernameTaken($username): bool {
        $result = $this->db->query('SELECT COUNT(*) as count FROM users WHERE username = ?', [$username]);
        return $result[0]['count'] > 0;
    }
}
