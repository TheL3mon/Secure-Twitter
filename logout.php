<?php
       session_start();
       $user_id = $_SESSION['user_id'];
    // session_destroy();
    // header('Location: .');
    // exit();

    if(isset($_SESSION['user_id']))
{
    $_SESSION=array();
    unset($_SESSION);
    session_destroy();
    header('Location: .');
    exit();
}
    