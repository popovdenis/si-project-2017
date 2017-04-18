<?php
require_once '../core/Entity.php';

class User extends Entity implements Serializable
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
     * @var \DateTime
     */
    private $createdAt;
    
    /**
     * User constructor.
     *
     * @param $userData
     */
    public function __construct($userData)
    {
        if (isset($userData['username'])) {
            $this->setUsername($userData['username']);
        }
        if (isset($userData['email'])) {
            $this->setEmail($userData['email']);
        }
        if (isset($userData['password'])) {
            $this->setPassword($userData['password']);
        }
        
        $this->setCreatedAt(new DateTime());
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
        
        return $this;
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
        
        
        return $this;
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
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
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
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
        
        return $this;
    }
    
    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        
        return $this;
    }
    
    /**
     * Get user info.
     *
     * @return array
     */
    public function getUserInfo()
    {
        return [
            'id' => $this->getId(),
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'created_at' => $this->getCreatedAt()
        ];
    }
    
    /**
     * String representation of object
     *
     * @link  http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize($this->getUserInfo());
    }
    
    /**
     * Constructs the object
     *
     * @link  http://php.net/manual/en/serializable.unserialize.php
     *
     * @param string $serialized <p>
     *                           The string representation of the object.
     *                           </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        $userInfo = unserialize($serialized);
        $this
            ->setId($userInfo['id'])
            ->setUsername($userInfo['username'])
            ->setEmail($userInfo['email'])
            ->setCreatedAt($userInfo['created_at']);
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
        $createdAt = $this->getCreatedAt()->format('Y-m-d H:i:s');
        
        // подготовка запроса
        $query = "INSERT INTO users (username,email,password,createdAt) " .
                    "VALUES ('$username','$email','$password','$createdAt')";
        
        // выполнение запроса
        $result = $db->query($query);
        
        if (!$result) {
            die($db->error);
        }
        
        // save question and save insert_id to $this->id
        $this->setId($db->insert_id);
        
        return true;
    }
    
    public function getByEmailAndPassword()
    {
        $db=DB::getInstance();
        
        $username = $this->escape($this->getUsername());
        $email = $this->escape($this->getEmail());
        $password = $this->escape($this->getPassword());
      
        $query="SELECT * FROM users WHERE  email = '$email' AND password = 
'$password' LIMIT 1";
        
        $result=$db->query($query);
        
        if (!$result) {
            die($db->error);
        }
        
        return true;
    }
}
