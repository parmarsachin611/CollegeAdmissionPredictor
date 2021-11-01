<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/steps.css">
    <link rel="stylesheet" href="css/header.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home | College Admission Predictor</title>
</head>
<body>
    <section class="header">
        <nav>
            <a href="index.php"><h3 class="logo-text">College Admission Prediction</h3></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="./index.php">HOME</a></li>
                    <li><a href="./student/login.php">LOGIN</li>
                    <li><a href="./student/about.php">ABOUT</a></li>
                    <li><a href="./student/contact.php">CONTACT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="text-box">
            <h1>Predict your Admissions chances based on Real Data</h1>
            <p>
                CAP is the only free college guidance company that offers data-driven chancing, then works with students to help optimize their profiles. We use thousands of real acceptance results to fine-tune our algorithm. We also explain your chancing results and teach you how to strengthen your profile.
            </p>
            <a href="" class="hero-btn">Calculate My Chances</a>
        </div>
    </section>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'newcap'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'newcap'.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>
    <!-- --------JavaScript for toogle button-------- -->
    <script>

        var navLinks = document.getElementById("navLinks");

        function showMenu(){
            navLinks.style.right = "0";
        }
        
        function hideMenu(){
            navLinks.style.right = "-200px";
        }

    </script>
</body>
</html>