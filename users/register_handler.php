<?php
include_once 'User.php';

if (!empty($_POST)) {
    $username = trim(strip_tags($_POST['username']));
    $email = trim(strip_tags($_POST['email']));
    $password = trim(strip_tags($_POST['password']));
    $confirmation = trim(strip_tags($_POST['confirmation']));
    $createdAt = date("Y-m-d H:i:s");
    
    
    $username = (string) $username;
    $email = (string) $email;
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    
    $password = (string) $password;
    $password=md5($password);
    
    $confirmation = (string) $confirmation;
    $confirmation=md5($confirmation);
    
    if ($confirmation === $password) {
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'confirmation' => $confirmation,
            'createdAt' => $createdAt,
        ];
        
        $user = new User($userData);
        $user->save();
        
        session_start();
        $_SESSION['username']=$userData['username'];
        $_SESSION['email']=$userData['email'];
        $_SESSION['password']=$userData['password'];
        header('location: '.SITE);
        
    }
    
}


