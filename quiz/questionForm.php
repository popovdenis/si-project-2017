<?php
$value = 'next question';
if ($question == count($questions)-1) {
    $value = 'Finish';
}

?>
<form action="quizHandler.php" method="POST">
    Question: <?php echo $questions[$question]["question"] ?> <br/><br/>
    Answers: <br/>
    <?php $answers = Answer::getAnswersFromDBByQuestionId($question+1) ?>
    <?php shuffle($answers)?>
    <?php foreach ($answers as $item): ?>
        <?php echo $item ?> <input type="radio" name="answer" value=" <?php echo $item ?>"><br/>
    <?php endforeach; ?>
    <br/><br/>
    <input type="hidden" name="question" value="<?php echo $question; ?>">
    <input type="submit" value="<?php echo $value ?>">
</form>

