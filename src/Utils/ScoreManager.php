<?php

namespace App\Utils;

use PDO;
use RuntimeException;

class ScoreManager {
    public static function saveUserScore(string $playerName, int $score): void {
        try {
            $pdo = Database::getConnection();

            $query = "INSERT INTO scores (player_name, score) VALUES (:player_name, :score)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                ':player_name' => $playerName,
                ':score' => $score
            ]);

        } catch (\PDOException $e) {
            throw new RuntimeException("Erreur lors de l'enregistrement du score : " . $e->getMessage());
        }
    }
}

?>