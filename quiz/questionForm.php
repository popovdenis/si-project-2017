<?php require_once __DIR__ . "/../header.php" ?>
<?php require_once BASE_PATH . '/navbar.php'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once BASE_PATH . '/menu.php' ?>
<?php
$questionTitle = isset($questions[$question]) ? $questions[$question] : '';
?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="<?php echo SITE ?>/quiz/quizHandler.php" method="POST" style="align-content: center">
                            <label>Question: <?php echo $questionTitle ?></label>
                            <hr />
                            <div class="form-group">
                                <label for="exampleInputPassword1">Answers:</label>
                                <?php $answers = Answer::getAnswersFromDBByQuestionId($question) ?>
                                <?php shuffle($answers) ?>
                                <?php foreach ($answers as $answer) : ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="answer" value="<?php echo $answer['id'] ?>" />
                                        </label>
                                        <?php echo $answer['answer'] ?>
                                    </div>
                                <?php endforeach; ?>
                                <hr />
                                <input type="hidden" name="question" value="<?php echo $question; ?>">
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
