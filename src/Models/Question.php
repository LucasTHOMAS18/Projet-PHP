<?php

namespace App\Models;

class Question {
    private string $text;
    private array $choices;
    private string $correctAnswer;

    public function __construct(string $text, array $choices, string $correctAnswer) {
        $this->text = $text;
        $this->choices = $choices;
        $this->correctAnswer = $correctAnswer;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getChoices(): array {
        return $this->choices;
    }

    public function isCorrect(string $answer): bool {
        return $this->correctAnswer === $answer;
    }
}
