<?php
require_once '../DB.php';


class QuestionAnswer
{
    public function saveQuestionAndAnswer(Question $question, $answers)
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        /**
         * @var Answer $answer
         */
        foreach ($answers as $answer) {
            // экранирование переменных
            $answer_id = (int) $answer->getId();
            $question_id = (int) $question->getId();
            $answer_is_correct = (int) $answer->getIsCorrect();
            $query =
                "INSERT INTO questions_answers (`question_id`, `answer_id`, `is_correct`) VALUES ('$question_id', '$answer_id', '$answer_is_correct')";
            // выполнение запроса
            $result = $db->query($query);
            if (!$result) {
                echo $db->error;
                
                return false;
            }
        }
        
        return true;
    }
}
