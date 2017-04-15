<?php
require_once '../core/Entity.php';

class User extends Entity
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $passwordConfirm;
    /**
     * @var int
     */
    private $createdAt;
    
    
    
    public function __construct($userData)
    {
        if (isset($userData['username'])) {
            $this->setUsername($userData['username']);
        }
        
        if (isset($userData['email'])) {
             $this->setEmail($userData['email']);
        }
        if (isset($userData['password'])) {
            $this->setPassword($userData['password']) ;
        }
        if (isset($userData['confirmation'])) {
            $this->setPasswordConfirm($userData['confirmation']) ;
        }
        if (isset($userData['createdAt'])) {
            $this->setCreatedAt($userData['createdAt']) ;
        }
    }
    
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
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    
    
    
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
    }
    
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        
    }
    
    /**
     * @return string
     */
    public function getPasswordConfirm()
    {
        return $this->passwordConfirm;
    }
    
    /**
     * @param string $passwordConfirm
     *
     * @return User
     */
    public function setPasswordConfirm($passwordConfirm)
    {
        $this->passwordConfirm = $passwordConfirm;
    }
    
    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * @param int $createdAt
     *
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        
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
        $username = $this->escape($this->getUsername());
        $email = $this->escape($this->getEmail());
        $password = $this->escape($this->getPassword());
        $createdAt=$this->createdAt;
        
        // подготовка запроса
        $query = "INSERT INTO users (username,email,password,createdAt) VALUES ('$username','$email','$password','$createdAt')";
        
        // выполнение запроса
        $result = $db->query($query);
        
        if (!$result) {die($db->error);}
        
        // save question and save insert_id to $this->id
        $this->setId($db->insert_id);

        return true;
    }
}
