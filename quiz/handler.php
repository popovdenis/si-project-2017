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

class QuestionAnswer
{
    public function saveQuestionAndAnswer(Question $question, $answer)
    {
        
        // получение экземпляра класса DB
        $db = DB::getInstance();
        /**
         * @var Answer $answer
         */
        //foreach ($answers as $answer) {
            
            echo "<pre>";
           // var_dump($answer);
            echo "</pre>";
            // экранирование переменных
            $answer_id = $db->real_escape_string($answer->getId());
            $question_id = $db->real_escape_string($question->getId());
            $answer_is_correct = $db->real_escape_string($answer->getIsCorrect());
            /*
             * Цикл отрабатывает только для 1 элемента массива
             *
             *
             */
            $query =
                "INSERT INTO question_answers (`question_id`, `answer_id`, `is_correct`) VALUES ('$question_id', '$answer_id', '$answer_is_correct')";
            // выполнение запроса
            $result = $db->query($query);
            if (!$result) {
                return false;
            }
            
            return true;
        }
    //}
}

if (!empty($_POST)) {
    $questionFromPost = $_POST['question'];
    $answersFromPost = $_POST['answers'];
    $answersChecks = $_POST['answer_check'];
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
            'is_correct' => (isset($answersChecks[$answerId])) ? true : false,
        ];
        $answerObj = new Answer($answerData);
        // save answer
        $answerObj->save();
        
        $answers[] = $answerObj;
        $questionAnswerObj = new QuestionAnswer();
        // save question-answer
        $questionAnswerObj->saveQuestionAndAnswer($questionObj, $answerObj);
    }

}
echo "<pre>";
var_dump($answersChecks);
echo "</pre>";
/*
foreach ($answers as $answer) {
    
    echo "<pre>";
    var_dump($answer);
    echo "</pre>";
}
*/
