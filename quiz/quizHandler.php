<?php
include_once realpath(__DIR__ . '/../autoload.php');

$question = $answers = 0;
$questions = [];

if (!isset($_SESSION['finish_quiz'])) {
    if (isset($_POST["question"])) {
        $question = (int)$_POST["question"];
        $questionId = (int)$_POST["questionId"];
        if ($_POST["question"] > 0) {
            if (empty($_SESSION["answers"])) {
                $_SESSION["answers"] = [];
            }
            if (!isset($_POST["answer"][$questionId])) {
                $_SESSION["answers"][$questionId] = null;
            }
            $_SESSION["answers"][$questionId] = $_POST["answer"];
            
            $answers = $_SESSION["answers"];
        }
        $question++;
        $_SESSION['quiz_start'] = true;
    }
}

if (!isset($_SESSION['questions'])) {
    $questions = Question::getQuestionsFromDB();
    $_SESSION['questions'] = serialize($questions);
} else {
    $questions = unserialize($_SESSION['questions']);
}
?>
<?php
if (empty($questions)) {
    unset($_SESSION['answers']);
    unset($_SESSION['questions']);
    unset($_SESSION['quiz_start']);
    $_SESSION['quiz_finish'] = true;
    header('Location: ' . SITE . '/quiz.php');
    exit;
}
if (isset($_SESSION['quiz_finish'])) {
    unset($_SESSION['quiz_finish']);
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
