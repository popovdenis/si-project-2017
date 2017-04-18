<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (!session_id()) {
    session_start();
}

if (!empty($_POST)) {
    $username = isset($_POST['username']) ? strip_tags(trim($_POST['username'])) : '';
    $email = isset($_POST['email']) ? strip_tags(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? strip_tags(trim($_POST['password'])) : '';
    
    $result = false;
    $message = '';
    if (empty($username || $email || $password)) {
        $message = 'Заполните пожулуйста поля формы';
    } else {
        $userData = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];
        
        $user = new User($userData);
        $result = $user->getByUnameEmailAndPassword();
        
        if ($result) {
            $message = 'Вы успешно вошли, привет :) ' . $user->getUsername() . '!';
            $_SESSION['userdata'] = serialize($user);
        }
    }
    
    $_SESSION['message'] = $message;
    $_SESSION['result'] = $result;
    
    if (!empty($error)) {
        header('location: ' . SITE . '/login_or_register_form.php');
    } else {
        header('location: ' . SITE);
    }
}
