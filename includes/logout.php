<?php

    session_start();
    if(isset($_SESSION['aid'])){
        unset($_SESSION['aid']);
        session_destroy();
        header("Location: ../admin/login.php");
    }
    if(isset($_SESSION['sid'])){
        unset($_SESSION['sid']);
        session_destroy();
        header("Location: ../student/login.php");
    }


?>