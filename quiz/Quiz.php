<?php
include_once realpath(__DIR__ . '/../autoload.php');

class Quiz
{
    /**
     * @var int
     */
    private static $correctAnswersCount = 0;
    
    /**
     * Get if quiz is started.
     *
     * @return bool
     */
    public static function isQuizStarted()
    {
        return isset($_SESSION['quiz_started']) ? $_SESSION['quiz_started'] : false;
    }
    
    /**
     * Start quiz.
     */
    public static function startQuiz()
    {
        self::$correctAnswersCount = 0;
        $_SESSION['quiz_started'] = true;
        $_SESSION['current_question'] = 0;
        
        $questions = Question::getQuestionsFromDB();
        $_SESSION['questions'] = serialize($questions);
        $_SESSION['questions_count'] = count($questions);
    }
    
    /**
     * Finish quiz.
     */
    public static function finishQuiz()
    {
        self::$correctAnswersCount = 0;
        $_SESSION['quiz_started'] = false;
        $_SESSION['current_question'] = 0;
        
        unset($_SESSION['questions']);
        unset($_SESSION['questions_count']);
        unset($_SESSION['answers']);
    }
    
    /**
     * Check if the current question is out of questions.
     *
     * @return bool
     */
    public static function hasNextQuestion()
    {
        return $_SESSION['current_question'] <= $_SESSION['questions_count'];
    }
    
    /**
     * Set current question index.
     *
     * @param int $questionIndex Current question index
     */
    public static function setCurrentQuestionIndex($questionIndex)
    {
        $_SESSION['current_question'] = $questionIndex;
    }
    
    /**
     * Get current question index.
     *
     * @return int
     */
    public static function getCurrentQuestionIndex()
    {
        return (int) $_SESSION['current_question'];
    }
    
    /**
     * Get current question.
     *
     * @return null|array
     */
    public static function getCurrentQuestion()
    {
        $currentQuestion = null;
        if (!empty($_SESSION['questions'])) {
            $questions = unserialize($_SESSION['questions']);
            $currentQuestionIndex = $_SESSION['current_question'];
            if (array_key_exists($currentQuestionIndex, $questions)) {
                $currentQuestion = $questions[$currentQuestionIndex];
            }
        }
        
        return $currentQuestion;
    }
    
    /**
     * Get quiz process in percents.
     *
     * @return float|int
     */
    public static function getQuizProgressPercent()
    {
        $question = $_SESSION['current_question'];
        $questionsCount = $_SESSION['questions_count'];
        $questionPercent = floor((($question * 100) / $questionsCount));
        $questionPercent = $questionPercent == 100 ? 96 : $questionPercent;
        
        return $questionPercent;
    }
    
    /**
     * Save user's answer on the question.
     *
     * @param int $questionId
     * @param int $answer
     */
    public static function saveAnswer($questionId, $answer)
    {
        if (empty($_SESSION["answers"])) {
            $_SESSION["answers"] = [];
        }
        if (!isset($_POST["answer"][$questionId])) {
            $_SESSION["answers"][$questionId] = null;
        }
        $_SESSION["answers"][$questionId] = $answer;
    }
    
    /**
     * Get questions count.
     *
     * @return int
     */
    public static function getQuestionsCount()
    {
        return isset($_SESSION['questions_count']) ? $_SESSION['questions_count'] : 0;
    }
    
    /**
     * Calculate correct answers.
     */
    public static function calculateCorrectAnswers()
    {
        $correctAnswers = 0;
        if (!empty($_SESSION['questions'])) {
            $questions = unserialize($_SESSION['questions']);
            $questionsIds = array_column($questions, 'id');
            $correctAnswersIds = QuestionAnswer::getAnswersByQuestionsIds($questionsIds);
            
            if (isset($_SESSION['answers'])) {
                $userAnswers = $_SESSION['answers'];
                foreach ($userAnswers as $questionId => $answerId) {
                    if (isset($correctAnswersIds[$questionId]) && $correctAnswersIds[$questionId] == $answerId) {
                        $correctAnswers++;
                    }
                }
            }
        }
        
        self::$correctAnswersCount = $correctAnswers;
    }
    
    /**
     * Get correct answers.
     *
     * @return int
     */
    public static function getCorrectAnswers()
    {
        return self::$correctAnswersCount;
    }
    
    /**
     * Save quiz results.
     *
     * @param User $user
     * @param int  $results
     *
     * @return bool
     */
    public function saveQuizResult(User $user, $results)
    {
        $db = DB::getInstance();
        
        $userId = $user->getId();
        $results = (int) $results;
        $createdAt = new DateTime();
        $createdAt = $createdAt->format('Y-m-d H:i:s');
        
        $query = "INSERT INTO quiz_results (user_id, quiz_results,created_at) VALUES ($userId, $results, $createdAt)";
        $result = $db->query($query);
        if (!$result) {
            die($db->error);
        }
        
        return true;
    }
}
