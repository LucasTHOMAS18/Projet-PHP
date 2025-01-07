<?php

namespace App\Models;

class Quiz {
    private string $title;
    private array $questions;

    public function __construct(string $title, array $questions = []) {
        $this->title = $title;
        $this->questions = $questions;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getQuestions(): array {
        return $this->questions;
    }

    public function addQuestion(Question $question): void {
        $this->questions[] = $question;
    }
}
