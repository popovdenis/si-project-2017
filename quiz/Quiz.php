<?php
require_once BASE_PATH . '/core/Entity.php';

class Quiz  extends Entity
{
public $user;
private $results;
private $createdAt;

  
    
    
    
    
    public function getResults()
    {
        return $this->results;
    }
    
    public function setResults($results)
    {
        $this->results=$results;
        return $this;
    }
    
    /**
     * @return  bool
     */
public function saveQuizResult(User $user, $results)
{
    
    $db = DB::getInstance();
    
    $id=$user->getId();
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
