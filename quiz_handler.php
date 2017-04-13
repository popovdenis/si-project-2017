<?php

class Question
{
    private $id;
    
    private $question;
    
    public function __construct($questionData)
    {
        if (isset($questionData['id'])) {
            $this->id = $questionData['id'];
        }
        if (isset($questionData['question'])) {
            $this->question = $questionData['question'];
        }
    }
    
    public function save()
    {
        // save question and save insert_id to $this->id
        // return true or false
    }
}

class Answer
{
    private $id;
    
    private $answer;
    
    private $isCorrect;
    
    public function __construct($answerData)
    {
        if (isset($answerData['id'])) {
            $this->id = $answerData['id'];
        }
        if (isset($answerData['answer'])) {
            $this->answer = $answerData['answer'];
        }
        if (isset($answerData['is_correct_answer'])) {
            $this->isCorrect = $answerData['is_correct_answer'];
        }
    }
    
    public function save()
    {
        // save answer and save insert_id to $this->id
        // return true or false
    }
}

class QuestionAnswer
{
    public function saveQuestionAndAnswer(Question $question, $answers)
    {
        foreach ($answers as $answer) {
            /**
             * @var $anwer Answer
             */
            
        }
        // save question-answer
        // return true or false
    }
}


if (!empty($_POST)) {
    $questionFromPost = $_POST['question'];
    $answersFromPost = $_POST['answers'];
    
    // validate post
    $questionFromPost = trim(strip_tags($questionFromPost));
    $answersFromPost = trim(strip_tags($answersFromPost));
    
    // prepare question data
    $questionData = [
        'question' => $questionFromPost,
    ];
    
    $questionObj = new Question($questionData);
    // save question
    $questionObj->save();
    
    // iterate answers
    $answers = [];
    foreach ($answersFromPost as $answer) {
        // prepare answer data
        $answerData = [
            'answer' => $answer,
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
