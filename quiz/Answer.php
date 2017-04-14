<?php
require_once '../core/DB.php';
require_once '../core/Entity.php';

class Answer extends Entity
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $answer;
    
    
    /**
     * @var bool
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
     * Return answer value.
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    
    /**
     * @param int    $answer
     * Set answer value.
     *
     * @param string $answer
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
    
    /**
     * Answer constructor.
     *
     * @param $answerData
     */
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
    
    /**
     * Save answer.
     *
     * @return bool
     */
    public function save()
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        // экранирование переменных
        $answer = $db->real_escape_string($this->getAnswer());
        
        // экранирование переменных
        $answer = $this->escape($this->getAnswer());
        // подготовка запроса
        $query = "INSERT INTO answers (`answer`) VALUES ('$answer')";
        // выполнение запроса
        $result = $db->query($query);
        if (!$result) {
            return false;
            die($db->error);
        }
        // save question and save insert_id to $this->id
        $this->setId($db->insert_id);
        
        return true;
    }
}
