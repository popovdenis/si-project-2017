<?php
require_once '../DB.php';

class Question
{
    use DB;
    
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var int
     */
    private $question;
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return int
     */
    public function getQuestion()
    {
        return $this->question;
    }
    
    /**
     * @param int $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }
    
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
        
        // экранирование переменных
        $question = $db->real_escape_string($this->getQuestion());
        // подготовка запроса
        $query = "INSERT INTO question (`question`) VALUES ('$question')";
        // выполнение запроса
        $result = $db->query($query);
        if (!$result) {
            return false;
        }
        // save question and save insert_id to $this->id
        $this->setId($db->insert_id);
    
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
        'question' => $questionFromPost,
    ];
    
    $questionObj = new Question($questionData);
    // save question
    $questionObj->save();
    
    // iterate answers
    foreach ($answersFromPost as $answer) {
        // prepare answer data
        $answerData = [
            'answer' => $answer,
            //'question'=>$questionFromPost,
            //'is_correct'=>true
        ];
        $answerObj = new Answer($answerData);
        // save answer
        $answerObj->save();
        
        $questionAnswerObj = new QuestionAnswer();
        // save question-answer
        $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answerObj);
    }
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    echo "<pre>";
    var_dump($answersFromPost);
    echo "</pre>";
    echo "<pre>";
    var_dump($answerData);
    echo "</pre>";
}
