<?php $value = 'next question'; ?>
<form action="quizHandler.php" method="POST">
    Question: <?php echo $questions[$question] ?> <br/><br/>
    Answers: <br/>
    <?php $answers = Answer::getAnswersFromDBByQuestionId($question) ?>
    <?php shuffle($answers) ?>
    <?php foreach ($answers as $answer): ?>
        <?php echo $answer['answer'] ?> <input type="radio" name="answer" value="<?php echo $answer['id'] ?>"><br/>
    <?php endforeach; ?>
    <br/><br/>
    <input type="hidden" name="question" value="<?php echo $question; ?>">
    <input type="submit" value="<?php echo $value ?>">
</form>

