<?php

namespace App\Providers;

class JSONProvider {
    public static function load(string $filepath): array {
        if (!file_exists($filepath)) {
            throw new \Exception("Le fichier $filepath est introuvable.");
        }
        return json_decode(file_get_contents($filepath), true);
    }
}
