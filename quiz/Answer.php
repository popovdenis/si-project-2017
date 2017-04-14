<?php
require_once '../DB.php';


class Answer
{
    /**
     * @var int
     *
     */
    private $id;
    /**
     * @var int
     *
     */
    private $answer;
    /**
     * @var bool
     *
     */
    private $isCorrect;
    
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
    public function getAnswer()
    {
        return $this->answer;
    }
    
    /**
     * @param int $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
    
    /**
     * @return bool
     */
    public function getIsCorrect()
    {
        return $this->isCorrect;
    }
    
    /**
     * @param bool $isCorrect
     */
    public function setIsCorrect($isCorrect)
    {
        $this->isCorrect = $isCorrect;
    }
    
    public function __construct($answerData)
    {
        if (isset($answerData['id'])) {
            $this->id = $answerData['id'];
        }
        if (isset($answerData['answer'])) {
            $this->answer = $answerData['answer'];
        }
        if (isset($answerData['is_correct'])) {
            $this->isCorrect = $answerData['is_correct'];
        }
    }
    
    public function save()
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        // экранирование переменных
        $answer = $db->real_escape_string($this->getAnswer());
        // подготовка запроса
        $query = "INSERT INTO answers (`answer`) VALUES ('$answer')";
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
