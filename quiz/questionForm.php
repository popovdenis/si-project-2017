<?php require_once "quizHead.php" ?>
<?php require_once "quizHeader.php" ?>
<?php require_once '../navbar.php'; ?>

<?php $value = 'next question'; ?>
<!-- LOGO HEADER END-->
<?php $title = QUIZ; ?>
<?php require_once '../menu.php' ?>
<!-- MENU SECTION END-->
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <form action="quizHandler.php" method="POST">
                    <div class="panel-heading">
                        Question: <?php echo $questions[$question] ?> <br/><br/>
                    </div>
                    <div class="panel-body">
                        Answers: <br/>
                        <?php $answers = Answer::getAnswersFromDBByQuestionId($question) ?>
                        <?php shuffle($answers) ?>
                        <?php foreach ($answers as $answer): ?>
                            <input type="radio" name="answer"
                                   value="<?php echo $answer['id'] ?>"> <?php echo $answer['answer'] ?>
                            <br/>
                        <?php endforeach; ?>
                        <br/><br/>
                        <input type="hidden" name="question" value="<?php echo $question; ?>">
                    </div>
                    <div class="panel-footer">
                        <input type="submit" class="btn btn-primary btn-sm btn-wide" value="<?php echo $value ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php require_once '../footer.php' ?>
