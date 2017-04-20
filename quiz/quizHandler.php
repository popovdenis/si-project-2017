<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (isset($_POST["cancel_quiz"])) {
    if ((bool) $_POST["cancel_quiz"] && Quiz::isQuizStarted()) {
        header('Location: ' . SITE . '/quiz/result.php');
        exit;
    }
}

if (isset($_POST["question"])) {
    $question = (int) $_POST["question"];
    $questionId = (int) $_POST["questionId"];
    $answer = isset($_POST["answer"]) ? (int) $_POST["answer"] : 0;
    
    $result = false;
    $message = '';
    if ($question > 0 && empty($answer)) {
        $message = 'Please choose any answer!';
    } else {
        if ($question > 0) {
            Quiz::saveAnswer($questionId, $answer);
        }
        $question++;
        Quiz::setCurrentQuestionIndex($question);
        $result = true;
    }
    
    $_SESSION['message'] = $message;
    $_SESSION['result'] = $result;
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
