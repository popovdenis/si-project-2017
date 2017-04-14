<?php
require_once '../DB.php';
require_once 'Question.php';
require_once 'Answer.php';
require_once 'QuestionAnswer.php';

if (!empty($_POST)) {
    $questionFromPost = $_POST['question'];
    $answersFromPost = $_POST['answers'];
    $answersChecks = $_POST['answer_check'];
    // validate data
    
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
            'is_correct' => (isset($answersChecks[$answerId])) ? true : false,
        ];
        $answerObj = new Answer($answerData);
        // save answer
        $answerObj->save();
        $answers[] = $answerObj;
    }
    $questionAnswerObj = new QuestionAnswer();
    // save question-answer
    $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answers);
}


