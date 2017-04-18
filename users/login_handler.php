<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (!session_id()) {
    session_start();
}

if (!empty($_POST)) {
    $username = isset($_POST['username']) ? strip_tags(trim($_POST['username'])) : '';
    $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    
    
    if (empty($username && $email && $password)) {
        $error = 'Fill in the form field!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email format wrong!';
    } else {
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];
        
        $user = new User($userData);
        $result = $user->getByEmailAndPassword();
        
        
        if ($username !== $result['username']) {
            $error = 'Username wrong !';
        } elseif ($email !== $result['email']) {
            $error = '@email Wrong !';
        } elseif (md5($password) !== $result['password']) {
            $error = 'Password Wrong !';
        }
        
        
        if ($username === $result['username'] && $email === $result['email']
            && md5($password) === $result['password']
        ) {
            $success = 'You logged in successfully, hello :) ' . $user->getUsername() . '!';
            $_SESSION['userdata'] = serialize($user);
        } elseif ($username !== $result['username'] && $email !== $result['email']
            && md5($password) !== $result['password']
        ) {
            $error = 'There is no such user, please register.';
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
