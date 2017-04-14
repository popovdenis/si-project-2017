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
        $query = "INSERT INTO questions (`question`) VALUES ('$question')";
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
