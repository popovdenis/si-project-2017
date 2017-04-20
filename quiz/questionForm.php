<?php require_once __DIR__ . "/../header.php" ?>
<?php require_once BASE_PATH . '/navbar.php'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once BASE_PATH . '/menu.php' ?>
<?php
$currentQuestion = Quiz::getCurrentQuestion();
$questionTitle = $currentQuestion['question'];
$questionPercent = Quiz::getQuizProgressPercent();
?>
<script>
    $(document).ready(function() {
        $('input[name="close_quiz"]').on('click', function () {
            $('input[name="cancel_quiz"]').val(1);
            $('#quiz_form').submit();
        });
    });
</script>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <?php if (!empty($_SESSION['message'])) : ?>
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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="quiz_form" action="<?php echo SITE ?>/quiz/quizHandler.php"
                              method="POST" style="align-content: center">
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" role="progressbar"
                                     aria-valuenow="<?php echo $questionPercent ?>" aria-valuemin="0"
                                     aria-valuemax="100" style="width: <?php echo $questionPercent ?>%">
                                    <span class="sr-only"><?php echo $questionPercent ?>% Complete (success)</span>
                                </div>
                            </div>
                            <label>Question: <?php echo $questionTitle ?></label>
                            <hr/>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Answers:</label>
                                <?php $answers = Answer::getAnswersFromDBByQuestionId($currentQuestion['id']) ?>
                                <?php shuffle($answers) ?>
                                <?php foreach ($answers as $answer) : ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer" value="<?php echo $answer['id'] ?>"/>
                                        </label>
                                        <?php echo htmlspecialchars($answer['answer']) ?>
                                    </div>
                                <?php endforeach; ?>
                                <hr/>
                                <input type="hidden" name="question"
                                       value="<?php echo Quiz::getCurrentQuestionIndex(); ?>">
                                <input type="hidden" name="questionId" value="<?php echo $currentQuestion['id']; ?>">
                                <input type="hidden" name="cancel_quiz" value="0">
                                <input type="button" name="close_quiz"
                                       class="btn btn-social btn-google"
                                       value="Close question">&nbsp;&nbsp;
                                <input type="submit" class="btn btn-info" value="Next question">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once BASE_PATH . '/footer.php' ?>
