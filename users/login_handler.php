<?php
session_start();
include_once 'User.php';

if (!empty($_POST)) {
    $username = isset($_POST['username']) ? strip_tags(trim($_POST['username'])) : '';
    $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    
    
    $error = $success = '';
    if(empty($username || $email || $password )){
        $error='Заполните пожулуйста поля формы';
    }
    
    else {
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
        
        $user = new User($userData);
        $result = $user->getByEmailAndPassword();
        
        
        if ($result) {
            $success = 'You logged in successfully, hello :) ' . $user->getUsername() . '!';
            $_SESSION['userdata'] = serialize($user);
        }
    }
    
    $_SESSION['error'] = '';
    $_SESSION['success'] = '';
    
    if (!empty($error)) {
        $_SESSION['error'] = $error;
        
        header('location: ' . SITE . '/login_or_register_form.php');
    } elseif (!empty($success)) {
        $_SESSION['success'] = $success;
        
        header('location: ' . SITE);
    }

}
