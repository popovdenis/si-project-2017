<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (!session_id()) {
    session_start();
}

$question = $answers = 0;
if (isset($_POST["question"])) {
    $question = (int) $_POST["question"];
    if ($_POST["question"] > 0) {
        if (empty($_SESSION["answers"])) {
            $_SESSION["answers"] = [];
        }
        if (!isset($_POST["answer"])) {
            $_SESSION["answers"][$question] = null;
        }
        $_SESSION["answers"][$question] = (int) trim($_POST["answer"]);
        $answers = $_SESSION["answers"];
    }
    $question++;
}

$questions = [];
if (!isset($_SESSION['questions'])) {
    $questions = Question::getQuestionsFromDB();
    $_SESSION['questions'] = serialize($questions);
} else {
    $questions = unserialize($_SESSION['questions']);
}
?>
<?php

if (count($questions) == count($answers)) {
    include "result.php";
} elseif ($question > 0) {
    include "questionForm.php";
} else {
    unset($_SESSION['answers']);
    include "start.php";
}
