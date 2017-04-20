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
            <form action="quizHandler.php" method="POST">
                <input type="hidden" name="question" value=" <?php echo 0 ?> ">
                <input type="submit" value="Start the quiz">
            </form>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/footer.php' ?>
