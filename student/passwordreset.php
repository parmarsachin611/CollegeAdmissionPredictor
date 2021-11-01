<?php

// INCLUDE DATABASE CONNECTION 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';

if (isset($_POST['send_otp'])) {
    $email = mysqli_real_escape_string($con,trim($_POST['email']));
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email) ){
        echo "
            <script>
                alert('Enter Valid Data.');
                window.location='login.php';
            </script>";
    }
    else{
        $sql1 = mysqli_query($con,"SELECT * FROM student WHERE email = '$email'");
        if(!mysqli_num_rows($sql1)==1){
            echo "
            <script>
                alert('Email is not register in system.');
                window.location='login.php';
            </script>";
        }else{
                $otp = rand(100000, 999999); //generates random otp
                $_SESSION['session_otp'] = $otp;
                $sub = "CAP Registration Email verification";
                $message = "Your one time email verification code is - " . $otp;
                $headers = "From: crce.9076.ecs@gmail.com";
                // echo $email;
                if(mail($email,$sub,$message,$headers)){
                    echo "
                    <script>
                    alert('OTP sent to email.');
                    window.location='newpass.php';
                    </script>";
                
                }else{
                    echo "<script>alert('Email sending fail....')
                          </script>";
                }
                
                
                
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset | College Admission Predictor</title>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'links.php';
    ?>
</head>
<body>
    <section class="header">
        <?php
            include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
        ?>
        <div class="container">
            <div class="card">
                <div class="inner-box" id="card">
                    <!-- PASSWORD RESET -->
                    <div class="card-front">
                        <h2>PASS-RESET</h2>
                        <form action="newpass.php" method="POST" enctype="multipart/form-data" id="display1">
                            <input type="email" name="email" class="input-box" placeholder="Your Email Id"  required>
                            <button type="submit" name="send_otp"  class="submit-btn">GENERATE OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>
   
</body>
</html>