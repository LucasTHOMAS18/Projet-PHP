<?php

require_once __DIR__ . '/../src/Utils/Autoloader.php';

use App\Utils\Autoloader;
use App\Controllers\QuizController;

Autoloader::register();

$action = $_GET['action'] ?? 'quiz';

switch ($action) {
    case 'quiz':
        QuizController::showQuiz();
        break;
    case 'check':
        QuizController::checkAnswers();
        break;
    case 'results':
        QuizController::showResults();
        break;
    default:
        echo "Action non reconnue.";
        break;
}
