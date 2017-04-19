<?php

include_once realpath(__DIR__ . '/../autoload.php');

class Quiz  extends Entity
{
    
private $results;
    
    /**
     * @return  bool
     */
public function saveQuizResult(User $user, $results)
{
    
    $db = DB::getInstance();
    
    $id=$user->getId();
    $this->results=(int)$this->results;
    $quiz_results=$this->results;
    $createdAt=new DateTime();
    $createdAt = $createdAt->format('Y-m-d H:i:s');
    
    $query="INSERT INTO quiz_results (user_id,quiz_results,created_at) VALUES ($id,$quiz_results,$createdAt)";
    $result=$db->query($query);
    if (!$result) {
        die($db->error);
    }
    return true;
}


}
