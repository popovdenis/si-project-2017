<?php
if(!empty($_SESSION['userdata']))
{
    session_destroy();
    unset($_SESSION['userdata']);
    header('location: http://127.0.0.3/si-project');
}
else
{
    header('location: http://127.0.0.3/si-project');
}
