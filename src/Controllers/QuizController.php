<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Providers\JSONProvider;
use App\Utils\ScoreManager;


class QuizController {
    public static function showQuiz() {
        session_start();
    
        $data = JSONProvider::load(__DIR__ . '/../../data/quizzes.json');
        $maxQuestions = count($data['questions']);
        $nbQuestions = $_POST['nbQuestions'] ?? ($_SESSION['nbQuestions'] ?? $maxQuestions);
    
        $nbQuestions = max(1, min($nbQuestions, $maxQuestions));
        $_SESSION['nbQuestions'] = $nbQuestions;
    
        $selectedQuestions = array_slice($data['questions'], 0, $nbQuestions);
    
        $quiz = new Quiz($data['title'], []);
        foreach ($selectedQuestions as $q) {
            $quiz->addQuestion(new Question($q['text'], $q['choices'], $q['answer']));
        }
    
        $_SESSION['maxQuestions'] = $maxQuestions;
    
        require __DIR__ . '/../../public/templates/quiz.php';
    }
    
    

    public static function checkAnswers() {
        session_start();

        $answers = $_POST['answers'] ?? [];
        $data = JSONProvider::load(__DIR__ . '/../../data/quizzes.json');
        $correctAnswers = array_map(fn($q) => $q['answer'], $data['questions']);

        $score = 0;
        foreach ($answers as $index => $answer) {
            if ($answer === $correctAnswers[$index]) {
                $score++;
            }
        }

        $_SESSION['score'] = $score;

        // Enregistrement dans la base de données
        ScoreManager::saveUserScore($_SESSION['username'], $score);

        header('Location: index.php?action=results');
    }

    public static function showResults() {
        require __DIR__ . '/../../public/templates/results.php';
    }

    public static function importQuiz() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['quizFile'])) {
            $file = $_FILES['quizFile']['tmp_name'];
    
            if (file_exists($file)) {
                $data = json_decode(file_get_contents($file), true);
    
                if (isset($data['title']) && isset($data['questions'])) {
                    file_put_contents(__DIR__ . '/../../data/quizzes.json', json_encode($data, JSON_PRETTY_PRINT));
                    header('Location: index.php?action=quiz');
                    exit;
                } else {
                    echo "Fichier JSON invalide.";
                }
            } else {
                echo "Aucun fichier téléchargé.";
            }
        }
        require __DIR__ . '/../../public/templates/importQuiz.php';
    }
    
    public static function exportQuiz() {
        $data = JSONProvider::load(__DIR__ . '/../../data/quizzes.json');
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="quiz.json"');
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    public static function login() {
        session_start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            if (UserManager::login($username, $password)) {
                header('Location: index.php?action=quiz');
                exit;
            } else {
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    
        require __DIR__ . '/../../public/templates/login.php';
    }
    
    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            try {
                UserManager::register($username, $password);
                header('Location: index.php?action=login');
                exit;
            } catch (\Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
    
        require __DIR__ . '/../../public/templates/register.php';
    }
    
    public static function listQuizzes() {
        $data = JSONProvider::load(__DIR__ . '/../../data/quizzes.json');
        require __DIR__ . '/../../public/templates/listQuizzes.php';
    }
    
    public static function createQuiz() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $questions = json_decode($_POST['questions'], true);
    
            $data = ['title' => $title, 'questions' => $questions];
            file_put_contents(__DIR__ . '/../../data/quizzes.json', json_encode($data, JSON_PRETTY_PRINT));
    
            header('Location: index.php?action=list');
            exit;
        }
        require __DIR__ . '/../../public/templates/createQuiz.php';
    }
    
    
}