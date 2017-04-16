<?php
require_once '../core/DB.php';
require_once '../core/Entity.php';

class Question extends Entity
{
    
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var int
    
    
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
     * @return int
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
        $query = "INSERT INTO questions (`question`) VALUES ('$question')";
        // выполнение запроса
        $result = $db->query($query);
        if (!$result) {
            die($db->error);
        }
        // save question and save insert_id to $this->id
        $this->setId($db->insert_id);
        
        return true;
    }
    
    
    public static function getQuestionFromDB()
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        /*
         * @var array
         *
         */
        $array = [];
        $query = "SELECT q.id as `id`, q.question as `question`, a.answer as `answer`
                    FROM questions q, answers a, questions_answers qa
                    WHERE q.id = question_id AND a.id = answer_id AND qa.is_correct = 1";
        $stmt = mysqli_prepare($db, $query);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            die('Users are not exist ' . $stmt->error);
        }
        while ($stmt->fetch()) {
            $stmt->bind_result($id, $question, $answer);
            $array[] = [
                'id'=> $id,
                'question'=> $question,
                'answer'=> $answer
            ];
            
        }
        return $array;
    }
}
