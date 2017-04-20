<?php
include_once realpath(__DIR__ . '/../autoload.php');

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
            $answer_id = (int) $answer->getId();
            $question_id = (int) $question->getId();
            $answer_is_correct = (int) $answer->getIsCorrect();
            $query = "INSERT INTO questions_answers (`question_id`, `answer_id`, `is_correct`) " .
                "VALUES ('$question_id', '$answer_id', '$answer_is_correct')";
            // выполнение запроса
            $result = $db->query($query);
            if (!$result) {
                die($db->error);
            }
        }
        
        return true;
    }
    
    public static function getAnswersByQuestionsIds($questionsIds)
    {
        // получение экземпляра класса DB
        $db = DB::getInstance();
        
        $query = "SELECT qa.answer_id, qa.question_id
            FROM questions_answers qa
            INNER JOIN answers a ON a.id = qa.answer_id
            INNER JOIN questions q ON q.id = qa.question_id
            WHERE qa.question_id IN (" . implode(',', $questionsIds) . ") AND qa.is_correct = 1";
        
        // выполнение запроса
        $result = $db->query($query);
        if (!$result) {
            die($db->error);
        }
        
        $answers = [];
        while ($answer = $result->fetch_assoc()) {
            $answers[$answer['question_id']] = $answer['answer_id'];
        }
        
        return $answers;
    }
}
