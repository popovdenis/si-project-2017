<?php require_once "header.php" ?>
<?php require_once 'navbar.php';
session_start();
if (isset($_SESSION['message'])) {
    $panelType = 'panel panel-success';
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} elseif (isset($_SESSION['mistake'])) {
    $panelType = 'panel panel-danger';
    $message = $_SESSION['mistake'];
    unset($_SESSION['mistake']);
} else {
    $panelType = 'panel panel-primary';
    $message = 'Enter the question and the answers';
}

?>

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
                <form action="quiz/handler.php" method="POST" style="align-content: center">
                    Enter the question:
                    <input type="text" name="question" class="form-control"  value="" placeholder="Text input" />
                    <hr />
                    Enter answers: <br/>
                    <?php for ($i = 1; $i <= 4; $i++) : ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="answer_check[<?php echo $i ?>]" value="1" /><input type="text" class="form-control" name="answers[<?php echo $i ?>]"  value="" placeholder="enter the answer <?php echo $i ?>" />
                            </label>
                        </div>
                    <?php endfor; ?>
                    <br/>
                    <input type="submit" value="save" <button class="btn btn-primary" <i class="fa fa-edit "></i> </button>
                </form>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="<?php echo $panelType ?>">
                    <div class="panel-heading">
                        Message
                    </div>
                    <div class="panel-body">
                        <p><?php echo $message;  ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>
