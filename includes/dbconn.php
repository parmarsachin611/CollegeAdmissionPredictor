<?php
    session_start();
    $dbHost = 'localhost';
    $dbName = 'collegeadmissionpredictor';
    $dbUsername = 'root';
    $dbPassword = '';
    $con = mysqli_connect($dbHost,$dbUsername,$dbPassword,$dbName);
    if (!$con)
    {
      die( "<script>alert('Connection Failed.')</script>" );
    }
?>