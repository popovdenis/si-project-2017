<?php require_once __DIR__ . "/../header.php" ?>
<?php require_once BASE_PATH . '/navbar.php'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once BASE_PATH . '/menu.php' ?>
<?php $_SESSION['quiz_start'] = true ?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div align="center" style="margin: 10%">
            <p> The test contains <?php echo count($questions) ?> questions. Good luck! </p>
            <form action="quizHandler.php" method="POST">
                <input type="hidden" name="question" value=" <?php echo 0 ?> ">
                <input type="hidden" name="questionId" value=" <?php echo 0 ?> ">
                <input type="submit" class="btn btn-primary btn-sm btn-wide" value="Start the quiz">
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/footer.php' ?>
