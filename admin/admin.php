<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';

    if(isset($_POST['submit'])){
        $admin = mysqli_real_escape_string($con,trim($_POST['admin']));
        $Pass = mysqli_real_escape_string($con,trim($_POST['password']));
        // $aPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // $sql = mysqli_query($con,"INSERT INTO `admin`(`adminusername`, `adminpass`) VALUES ('$admin','$aPassword')");
        
        $sql = "SELECT * FROM admin WHERE adminusername = '$admin'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $AdminPassword = $row['adminpass'];
        $aid = $row['aid'];
        
        if(password_verify($Pass,$AdminPassword)){
            session_start();
            $_SESSION['aid'] =  $aid;
            echo "<script>alert('Login Successful.')
            window.location='addCollege.php'
            </script>";
        }
        else{
            echo "<script>alert('Invalid Credentials.')</script>";
        }
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,600;1,700&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/studloginstyle.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>College Admission Prediction</title>
</head>

<body>
    <section class="header">
        <nav>
            <a href="..\index.html">
                <h3 class="logo-text">College Admission Prediction</h3>
            </a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="/index.html">HOME</a></li>
                    <li><a href="">STUDENT</a></li>
                    <li><a href="">ADMIN</a></li>
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="">CONTACT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <!-- -----------------ADMIN LOGIN----------------------- -->
        <div class="container">
            <div class="card">
                <div class="inner-box" id="card">
                    <!-- LOGIN -->
                    <div class="card-front">
                        <h2>ADMIN-LOGIN</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="text" name="admin" class="input-box" placeholder="Username"  required>
                            <input type="password" name="password" class="input-box" placeholder="Password" required>
                            <button type="submit" name="submit" class="submit-btn">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <!-- --------JavaScript-------- -->
    <script>

        // toogle button

        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }
        function hideMenu() {
            navLinks.style.right = "-200px";
        }
    </script>

</body>

</html>