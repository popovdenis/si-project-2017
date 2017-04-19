<?php
include_once realpath(__DIR__ . '/../config.php');

session_start();

if (!empty($_SESSION['userdata'])) {
    session_destroy();
    unset($_SESSION['userdata']);
}

header('Location:' . SITE);
