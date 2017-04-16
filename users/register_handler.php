<?php
if(!session_id()) {
    session_start();
}
include_once '../autoload.php';

if (!empty($_POST)) {
    $username = isset($_POST['username']) ? strip_tags(trim($_POST['username'])) : '';
    $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    $confirmation = isset($_POST['confirmation']) ? strip_tags(trim($_POST['confirmation'])) : '';
    
    $error = $success = '';
    if ($password != $confirmation) {
        $error = 'Пароли не совпадают!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email формат не верный!';
    } else {
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];
    
        $user = new User($userData);
        $result = $user->save();

        if ($result) {
            $success = 'Вы успешно зарегистрированы, ' . $user->getUsername() . '!';
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


