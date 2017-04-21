<?php
include_once realpath(__DIR__ . '/../autoload.php');

class Question extends Entity
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $question;
    
    /**
     * Question constructor.
     *
     * @param array $questionData
     */
    public function __construct($questionData)
    {
        if (isset($questionData['id'])) {
            $this->id = $questionData['id'];
        }
        if (isset($questionData['question'])) {
            $this->question = $questionData['question'];
        }
    }
    
    /**
     * Get a question id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set a question id.
     *
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Return a question value.
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }
    
    /**
     * Set a question value.
     *
     * @param int $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }
    
    /**
     * Save a question.
     *
     * @return bool
     */
    public function save()
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        // экранирование переменных
        $question = $this->escape($this->getQuestion());
        // подготовка запроса
        $query = "INSERT INTO questions (`question`) VALUES (?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $question);
        // выполнение запроса
        $result = $stmt->execute();
        if (!$result) {
            die($stmt->error);
        }
        // save question and save insert_id to $this->id
        $this->setId($stmt->insert_id);
        
        return true;
    }
    
    
    public static function getQuestionsFromDB()
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
    
        $query = "SELECT * FROM questions";
        if (!empty(QUIZ_LIMIT) && is_numeric(QUIZ_LIMIT)) {
            $query .= ' limit 120, ' . QUIZ_LIMIT;
        }
        $result = $db->query($query);
        if (!$result) {
            die($db->error);
        }
    
        $questions = [];
        $index = 1;
        while ($question = $result->fetch_assoc()) {
            $questions[$index] = $question;
            $index++;
        }
        
        return $questions;
    }
}
