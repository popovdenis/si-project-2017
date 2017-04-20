<?php
include_once realpath(__DIR__ . '/../autoload.php');

$question = $answers = 0;
$questions = [];

if (!isset($_SESSION['finish_quiz'])) {
    if (isset($_POST["question"])) {
        $question = (int)$_POST["question"];
        if ($_POST["question"] > 0) {
            if (empty($_SESSION["answers"])) {
                $_SESSION["answers"] = [];
            }
            if (isset($_POST["answer"])) {
                $_SESSION["answers"][$question] = $_POST["answer"];
            } else {
                $_SESSION["answers"][$question] = null;
            }
            $answers = $_SESSION["answers"];
        }
        $question++;
    }
    
    if (!isset($_SESSION['questions'])) {
        $questions = Question::getQuestionsFromDB();
        $_SESSION['questions'] = serialize($questions);
    } else {
        $questions = unserialize($_SESSION['questions']);
    }
}
?>
<?php
if (isset($_SESSION['finish_quiz'])) {
    unset($_SESSION['finish_quiz']);
    include "start.php";
} else {
    if (count($questions) == count($answers)) {
        include "result.php";
    } elseif ($question > 0) {
        include "questionForm.php";
    } else {
        unset($_SESSION['answers']);
        include "start.php";
    }
}
