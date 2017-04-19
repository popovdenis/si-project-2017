<?php
include_once realpath(__DIR__ . '/../autoload.php');

class Quiz extends Entity
{
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
