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
    $_SESSION['finish_quiz'] = true;
}
?>
<?php require_once __DIR__ . "/../header.php" ?>
<?php require_once BASE_PATH . '/navbar.php'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once BASE_PATH . '/menu.php' ?>

<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Quiz</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" align="center">
                <p> Your result is <?php echo $result ?> from <?php echo count($questions) ?> </p>
                <p><a href="<?php echo SITE ?>/quiz/quizHandler.php"> Start the test again </a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/footer.php' ?>
