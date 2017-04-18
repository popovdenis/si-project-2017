<?php
include_once '../config.php';

if(!empty($_SESSION['userdata']))
{
    session_destroy();
    unset($_SESSION['userdata']);
    //    Не работает может у тебя правильно удасьтся подключить
   //    header('location:'.SITE);
    header('location: http://127.0.0.3/si-project');
}

else
{
    //    Не работает может у тебя правильно удасьтся подключить
   //    header('location:'.SITE);
    header('location: http://127.0.0.3/si-project');
}
