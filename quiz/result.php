<?php
$result = 0;
$questions = [];
if (!empty($_SESSION["answers"]) && !empty($_SESSION['questions'])) {
    $questions = unserialize($_SESSION['questions']);
    $questionsIds = array_keys($questions);
    $correctAnswersIds = QuestionAnswer::getAnswersByQuestionsIds($questionsIds);
    
    $userAnswers = $_SESSION["answers"];
    
    foreach ($userAnswers as $questionId => $answerId) {
        if (isset($correctAnswersIds[$questionId]) && $correctAnswersIds[$questionId] == $answerId) {
            $result++;
        }
    }
    unset($_SESSION['answers']);
    unset($_SESSION['questions']);
}
?>
<p> Your result is <?php echo $result ?> from <?php echo count($questions) ?> </p>
<p><a href="<?php echo SITE ?>/quiz.php"> Start the test again </a></p>
