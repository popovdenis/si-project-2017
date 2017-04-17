<?php

require_once '../core/DB.php';
session_start();
require_once 'Question.php';
require_once 'Answer.php';
require_once 'QuestionAnswer.php';
require_once '../config.php';

$question = $answers = 0;
if (isset($_POST["question"])) {
    $question = (int)$_POST["question"];
    if ($_POST["question"] > 0) {
        /*
        if (empty($_SESSION["answers"])) {
            $_SESSION["answers"] = [];
        }
        if (isset($_POST["answer"])) {
            $_SESSION["answers"][$question] = $_POST["answer"];
        } else {
            $_SESSION["answers"][$question] = null;
        }
        $answers = $_SESSION["answers"];*/
    }
    $question++;
}


$questions = Question::getQuestionsFromDB();
//$answers = Answer::getAnswersFromDB();
?>
<?php

if (count($questions) == 4) {
    include "result.php";
} elseif ($question > 0) {
    include "questionForm.php";
} else {
    unset($_SESSION['answers']);
    include "start.php";
}




