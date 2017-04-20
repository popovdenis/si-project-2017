<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (isset($_POST["question"])) {
    $question = (int) $_POST["question"];
    $questionId = (int) $_POST["questionId"];
    if ($question > 0) {
        Quiz::saveAnswer($questionId, $_POST["answer"]);
    }
    $question++;
    Quiz::setCurrentQuestionIndex($question);
}

if (!Quiz::isQuizStarted()) {
    Quiz::startQuiz();
    if (Quiz::getQuestionsCount() == 0) {
        header('Location: ' . SITE . '/quiz.php');
        exit;
    }
    
    include "start.php";
} elseif (Quiz::hasNextQuestion()) {
    include "questionForm.php";
} else {
    include "result.php";
}
