<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (!empty($_POST)) {
    $questionFromPost = isset($_POST['question']) ? strip_tags(trim($_POST['question'])) : '';
    $answersFromPost = isset($_POST['answers']) ? $_POST['answers'] : '';
    $answersChecks = isset($_POST['answer_check']) ? $_POST['answer_check'] : '';
    
    $result = false;
    $message = '';
    if (empty($questionFromPost) || empty($answersFromPost) || empty($answersChecks)) {
        $message = 'Please enter all form data!';
    } else {
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
        $response = $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answers);
    
        if ($response) {
            $message = 'Questions and answers are saved successfully!';
            $result = true;
        } else {
            $message = 'Error while saving questions!';
        }
    }
    
    $_SESSION['message'] = $message;
    $_SESSION['result'] = $result;
}

header('Location:' . SITE . '/' . 'quiz.php');
