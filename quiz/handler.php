<?php
require_once '../core/DB.php';
require_once 'Question.php';
require_once 'Answer.php';
require_once 'QuestionAnswer.php';

session_start();

if (!empty($_POST)) {
    $questionFromPost = isset($_POST['question']) ? strip_tags(trim($_POST['question'])) : '';
    $answersFromPost = isset($_POST['answers']) ? $_POST['answers'] : '';
    $answersChecks = isset($_POST['answer_check']) ? $_POST['answer_check'] : '';
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
    $result = $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answers);
    // redirect to main quiz page with success message for user.
    if ($result) {
        $_SESSION['message'] = 'Questions and answers are saved successfully!';
    } else {
        $_SESSION['mistake'] = 'Error while saving questions!';
    }
    
}
header('Location:' . SITE . '/' . 'quiz.php');






