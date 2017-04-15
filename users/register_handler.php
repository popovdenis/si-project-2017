<?php
include 'User.php';

if(!empty($_POST)){
    $username=trim(strip_tags($_POST['username']));
    $email=trim(strip_tags($_POST['email']));
    $password=trim(strip_tags($_POST['password']));
    $confirmation=trim(strip_tags($_POST['confirmation']));
    $createdAt=date("Y-m-d H:i:s");
    
    $userData=[
        'username'=>$username,
        'email'=>$email,
        'password'=>$password,
        'confirmation'=>$confirmation,
        'createdAt'=>$createdAt
    ];
    
    $user = new User($userData);
    $user->save();
    
}


