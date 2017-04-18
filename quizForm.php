<?php require_once "header.php" ?>
<?php require_once 'navbar.php'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once 'menu.php' ?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Info Panel
                </div>
                <div class="panel-body">
                    <p>To begin test click on the button "Start the quiz". The test will be passed, if your result will be above 70%</p>
                </div>
            </div>
            <form action="quiz/quizHandler.php" method="POST">
                <input type="hidden" name="question" value="<?php echo 0 ?>">
                <input type="submit" class="btn btn-primary btn-lg" value="Start the quiz">
            </form>
        </div>
        <br />
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>
