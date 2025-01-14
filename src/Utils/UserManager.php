<?php

namespace App\Utils;

use App\Utils\Database;
use RuntimeException;

class UserManager {
    public static function register(string $username, string $password): void {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute([
            ':username' => $username,
            ':password' => $hashedPassword,
        ]);
    }

    public static function login(string $username, string $password): bool {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);

        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            return true;
        }

        return false;
    }
}
