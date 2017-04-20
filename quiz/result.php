<?php require_once __DIR__ . "/../header.php" ?>
<?php require_once BASE_PATH . '/navbar.php'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once BASE_PATH . '/menu.php' ?>

<?php
$questionsCount = $correctAnswers = 0;
if (Quiz::isQuizStarted()) {
    Quiz::calculateCorrectAnswers();
    $questionsCount = Quiz::getQuestionsCount();
    $correctAnswers = Quiz::getCorrectAnswers();
    Quiz::finishQuiz();
}
?>

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
                <p> Your result is <?php echo $correctAnswers ?> from <?php echo $questionsCount ?> </p>
                <p><a href="<?php echo SITE ?>/quiz/quizHandler.php"> Start the test again </a></p>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/footer.php' ?>
