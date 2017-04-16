<?php require_once "header.php";
require_once 'navbar.php';
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
            <form action="quiz/quizHandler.php" method="POST">
                <input type="submit" name="send" value="send">
            </form>
            
            Question:
            <div class="radio">
                <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked />
                    Option one is this and that&mdash;be sure to include why it's great
                </label>
            </div>
            <a href="#" class="btn btn-primary btn-lg">Next Question</a>
    </div><br />
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php require_once 'footer.php' ?>
