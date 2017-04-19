<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (!session_id()) {
    session_start();
}

if (!empty($_POST)) {
    $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    
    if (empty($email && $password)) {
        $error = 'Fill in the form field!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email format wrong!';
    } else {
        $userData = [
            'email' => $email,
            'password' => $password,
        ];
    
        $userObj = new User($userData);
        $userData = $userObj->getByEmailAndPassword();
        
        if (!$userData) {
            $error = 'User with such email and login is not found.';
        } else {
            $userObj->setId($userData['id']);
            $userObj->setUsername($userData['username']);
            $success = 'You logged in successfully, hello :) ' . $userObj->getUsername() . '!';
            $_SESSION['userdata'] = serialize($userObj);
        }
    }
    
    if (!empty($error)) {
        $_SESSION['error_login'] = $error;
        header('location: ' . SITE . '/login_or_register_form.php');
    } elseif (!empty($success)) {
        $_SESSION['success'] = $success;
        header('location: ' . SITE);
    }
}
