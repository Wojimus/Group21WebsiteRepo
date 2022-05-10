<?php
    //Start Session
    if (session_status() == PHP_SESSION_NONE){
        session_start();
    }
    //End Session
    if (session_status() == PHP_SESSION_ACTIVE){
        session_destroy();
    }
    header("location:../index.php");
?>