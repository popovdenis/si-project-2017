<?php
$value = 'next question';
if ($question == count($questions)) {
    $value = 'Finish';
}
?>
<form action="quizHandler.php" method="POST">
    Question: <?php echo $questions[$question]["question"] ?> <br/><br/>
    Answers: <br/>
    <?php //$answers = $questions[$question]["answers"]; ?>
    <?php //shuffle($answers) ?>
 
    <br/><br/>
    <input type="hidden" name="question" value="<?php echo $question; ?>">
    <input type="submit" value="<?php echo $value ?>">
</form>

