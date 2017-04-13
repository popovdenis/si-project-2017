<?php
require_once '../DB.php';

class Question
{
    use DB;
    
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
        // получение экземпляра класса DB
        $db = DB::getInstance();
        
        $firstname = 'William';
        $lastname = "O'Genry";
        
        // экранирование переменных
        $firstname = $db->real_escape_string($firstname);
        $lastname = $db->real_escape_string($lastname);
        // подготовка запроса
        $query = "INSERT INTO user (`firstname`, `lastname`) VALUES ('$firstname', '$lastname')";
        // выполнение запроса
        $result = $db->query($query);
        if (!$result) {
            return false;
        }
        // save question and save insert_id to $this->id
        $this->id = $db->insert_id;
    
        return true;
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
            $this->answer = $answerData['question'];
        }
        if (isset($answerData['is_correct_answer'])) {
            $this->isCorrect = $answerData['is_correct_answer'];
        }
    }
    
    public function save()
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
    
        $firstname = 'William';
        $lastname = "O'Genry";
    
        // экранирование переменных
        $firstname = $db->real_escape_string($firstname);
        $lastname = $db->real_escape_string($lastname);
        // подготовка запроса
        $query = "INSERT INTO user (`firstname`, `lastname`) VALUES ('$firstname', '$lastname')";
        // выполнение запроса
        $result = $db->query($query);
        if (!$result) {
            return false;
        }
        // save question and save insert_id to $this->id
        $this->id = $db->insert_id;
    
        return true;
    }
}

class QuestionAnswer
{
    public function saveQuestionAndAnswer(Question $question, Answer $answer)
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        // save question-answer
        // return true or false
    }
}

if (!empty($_POST)) {
    $questionFromPost = $_POST['question'];
    $answersFromPost = $_POST['answers'];
    
    // validate data
    
    // prepare question data
    $questionData = [
        'question' => $questionFromPost
    ];
    
    $questionObj = new Question($questionData);
    // save question
    $questionObj->save();
    
    // iterate answers
    foreach ($answersFromPost as $answer) {
        // prepare answer data
        $answerData = [
            'answer' => $answer
        ];
        $answerObj = new Answer($answerData);
        // save answer
        $answerObj->save();
        
        $questionAnswerObj = new QuestionAnswer();
        // save question-answer
        $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answerObj);
    }
}
