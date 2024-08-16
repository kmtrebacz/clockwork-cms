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
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $this->validateLogin($username, $password);
        session_start();
        $_SESSION['user_id'] = $this->getUserId($username); // Store user ID in session
        header('Location: /clockwork-admin/dashboard');
        exit();
    }

    public function handleSignup(): void {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $passwordRepeat = $_POST['password_repeat'] ?? '';

        if ($this->isUsernameTaken($username)) {
            echo "Error: User already exists.";
            return;
        }

        if ($password !== $passwordRepeat) {
            echo "Passwords do not match.";
            return;
        }

        $this->addUserToDB($username, $password);
        header('Location: /clockwork-admin/log-in');
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
