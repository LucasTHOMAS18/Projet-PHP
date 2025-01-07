<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Providers\JSONProvider;

class QuizController {
    public static function showQuiz() {
        $data = JSONProvider::load(__DIR__ . '/../../data/quizzes.json');
        $quiz = new Quiz($data['title'], []);
        foreach ($data['questions'] as $q) {
            $quiz->addQuestion(new Question($q['text'], $q['choices'], $q['answer']));
        }
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
        header('Location: index.php?action=results');
    }

    public static function showResults() {
        require __DIR__ . '/../../public/templates/results.php';
    }
}
