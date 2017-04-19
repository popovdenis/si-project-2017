<?php $value = 'next question'; ?>
<form action="quizHandler.php" method="POST">
    Question: <?php echo $questions[$question - 1]["question"] ?> <br/><br/>
    Answers: <br/>
    <?php $answers = Answer::getAnswersFromDBByQuestionId($question) ?>
    <?php shuffle($answers)?>
    <?php foreach ($answers as $item): ?>
        <?php echo $item['answer']  ?> <input type="radio" name="answer" value=" <?php echo $item['answer'] ?>"><br/>
    <?php endforeach; ?>
    <br/><br/>
    <input type="hidden" name="question" value="<?php echo $question; ?>">
    <input type="submit" value="<?php echo $value ?>">
</form>

