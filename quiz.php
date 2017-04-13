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
                <form action="quiz/handler.php" method="POST">
                    Enter the question:
                    <input type="text" name="question" value="" placeholder="enter the question"> <br/>
                    Enter answers: <br/>
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <input type="checkbox" name="answer_check" value="1">
                        <input type="text" name="answers[<?php echo $i ?>]" value="" placeholder="enter the answer 1">
                        <br/>
                    <?php endfor; ?>
                    <br/>
                    <input type="submit" value="save">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>
