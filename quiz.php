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
                <h1 class="page-head-line">Questions and Answers </h1>
            </div>
        </div>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="row">
                <div class="col-md-12">
                    <?php $cssClass = (isset($_SESSION['result']) && !$_SESSION['result']) ? 'alert-danger' : 'alert-success'; ?>
                    <div class="alert <?php echo $cssClass ?>"><?php echo $_SESSION['message'] ?></div>
                </div>
            </div>
            <?php unset($_SESSION['message']); ?>
            <?php unset($_SESSION['result']); ?>
        <?php endif ?>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="quiz/handler.php" method="POST" style="align-content: center">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Enter the question</label>
                                <input type="text" class="form-control" name="question" placeholder="Enter question">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Enter answers:</label>
                                <?php for ($i = 1; $i <= 4; $i++) : ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="answer_check[<?php echo $i ?>]" value="1" />
                                        </label>
                                        <input class="form-control display-inline width95"
                                               type="text" name="answers[<?php echo $i ?>]" value=""
                                               placeholder="enter the answer <?php echo $i ?>" />
                                    </div>
                                <?php endfor; ?>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-primary btn-sm btn-wide">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <a href="quiz/quizHandler.php" class="btn btn-primary btn-lg">Click to start the quiz</a>
    </div>
</div>
<!-- CONTENT-WRAPPER SECTION END-->
<?php require_once 'footer.php' ?>
