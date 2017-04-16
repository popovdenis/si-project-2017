<?php

require_once '../core/DB.php';
session_start();
require_once 'Question.php';
require_once 'Answer.php';
require_once 'QuestionAnswer.php';
require_once '../config.php';

if (!empty($_POST)) {
    $result = QuestionAnswer::getQuestionAndAnswer();

}
echo "<pre>";
var_dump($result);
echo "</pre>";


