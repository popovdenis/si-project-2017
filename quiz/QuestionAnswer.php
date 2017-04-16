<?php

require_once '../core/DB.php';
require_once '../core/Entity.php';

class QuestionAnswer extends Entity
{
    /**
     * Save question and answer relationship.
     *
     * @param Question $question Question entity.
     * @param array    $answers  Answers array.
     *
     * @return bool
     */
    
    public function saveQuestionAndAnswer(Question $question, $answers)
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        /**
         * @var Answer $answer
         */
        foreach ($answers as $answer) {
            // экранирование переменных
            $answer_id = $this->escape($answer->getId());
            $question_id = $this->escape($question->getId());
            $answer_is_correct = $this->escape($answer->getIsCorrect());
            $query = "INSERT INTO questions_answers (`question_id`, `answer_id`, `is_correct`) 
                        VALUES ('$question_id', '$answer_id', '$answer_is_correct')";
            // выполнение запроса
            $result = $db->query($query);
            if (!$result) {
                die($db->error);
            }
        }
        
        return true;
    }
    
    public function getQuestionAndAnswer()
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
