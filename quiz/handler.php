<?php

require_once '../core/DB.php';
session_start();
require_once 'Question.php';
require_once 'Answer.php';
require_once 'QuestionAnswer.php';
require_once '../config.php';

if (!empty($_POST)) {
    $questionFromPost = $_POST['question'];
    $questionFromPost = trim(strip_tags($questionFromPost));
    $answersFromPost = $_POST['answers'];
    $answersChecks = $_POST['answer_check'];
    
    // validate data
    $questionFromPost = trim(strip_tags($questionFromPost));
    
    // prepare question data
    $questionData = [
        'question' => $questionFromPost,
    ];
    $questionObj = new Question($questionData);
    // save question
    $questionObj->save();
    // iterate answers
    $answers = [];
    foreach ($answersFromPost as $answerId => $answer) {
        // prepare answer data
        $answerData = [
            'answer' => $answer,
            'is_correct' => isset($answersChecks[$answerId]) ? 1 : 0,
        ];
        $answerObj = new Answer($answerData);
        // save answer
        $answerObj->save();
        
        // collect answers
        
        $answers[] = $answerObj;
    }
    
    $questionAnswerObj = new QuestionAnswer();
    // save question-answer

    $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answers);
    header('Location: ../quiz.php');

    $result = $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answers);
    // redirect to main quiz page with success message for user.
    if ($result) {
        $_SESSION['message'] = 'Question and answers saved!';
    } else {
        $_SESSION['mistake'] = 'Error while saving questions!';
    }
    

}
header('Location: ../quiz.php');






