<?php require_once "header.php" ?>
<?php require_once 'navbar.php' ?>
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
            <div class="col-md-3 col-sm-3 col-xs-6">
                <form action="quiz_handler.php" method="POST">
                    Enter the question:
                    <input type="text" name="question" value="" placeholder="enter the question"> <br />
                    Enter answers: <br />
                    <input type="checkbox" name="" value="true"><input type="text" name="answer1" value="" placeholder="enter the answer 1">
                    <input type="text" name="answer2" value="" placeholder="enter the answer 2">
                    <input type="text" name="answer3" value="" placeholder="enter the answer 3">
                    <input type="text" name="answer4" value="" placeholder="enter the answer 4"> <br />
                    <input type="submit" value = "save and go to next question">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>
