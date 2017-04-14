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
            $answer_id = $db->escape ( (int) $answer->getId());
            $question_id = $db->escape ((int) $question->getId());
            $answer_is_correct = $db->escape ((int) $answer->getIsCorrect());
            $query =
                "INSERT INTO questions_answers (`question_id`, `answer_id`, `is_correct`) VALUES ('$question_id', '$answer_id', '$answer_is_correct')";
            // выполнение запроса
            $result = $db->query($query);
            if (!$result) {
                echo $db->error;
                
                return false;
                $answer_id = $this->escape($answer->getId());
                $question_id = $this->escape($question->getId());
                $answer_is_correct = $this->escape($answer->getIsCorrect());
                $query = "INSERT INTO questions_answers (`question_id`, `answer_id`, `is_correct`)" .
                    " VALUES ('$question_id', '$answer_id', '$answer_is_correct')";
                // выполнение запроса
                $result = $db->query($query);
                if (!$result) {
                    die($db->error);
                    
                }
            }
        }
        return true;
    }
}
