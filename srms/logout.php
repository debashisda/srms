<?php
    session_start();
    session_unset();
    session_destroy();
    if (isset($_COOKIE['PHPSESSID'])) 
    {
        echo $_COOKIE['PHPSESSID'];
    } 

    //header('location:index.php');
?>