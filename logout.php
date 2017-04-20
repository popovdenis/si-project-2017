<?php
include_once realpath(__DIR__ . '/../autoload.php');

if (!empty($_SESSION['userdata'])) {
    session_destroy();
    unset($_SESSION['userdata']);
    
}

header('location:' . SITE);


