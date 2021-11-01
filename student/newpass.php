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
                $headers = "From: parmarsachin707@gmail.com";
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
if(isset($_POST['passsubmit'])){
    $email = mysqli_real_escape_string($con,trim($_POST['email']));
    $otp = mysqli_real_escape_string($con,trim($_POST['otp']));
    $pass = mysqli_real_escape_string($con,$_POST['pass']);
    
    if(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%.^&*])[a-zA-Z0-9!@#$._\-%^&*]{8,}$/",$pass)  ){
        $secure = 2;
        echo "<script>alert('Password must have A-Z,0-9 & Special Character');
        window.location='login.php';
        </script>";
    }
    else{
        if ($otp == $_SESSION['session_otp']) {
            unset($_SESSION['session_otp']);
            // Password Encryption
            $cpass = password_hash($pass, PASSWORD_BCRYPT);
            // Insert Query
            $query = "UPDATE student SET password = '$pass' WHERE email = '$email'";
            $record = mysqli_query($con,$query);
            if ($record) {
                echo "<script>alert('Password changed succesfully.');
                window.location='login.php';
                </script>";
            }
            else{
                echo "<script>alert('Something went wrong.');
                window.location='login.php';
                </script>";
            }
        }else{
            echo "<script>alert('Invalid OTP.');
            window.location='login.php';
            </script>";
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
    <title>Set New Password | College Admission Predictor</title>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'links.php';
    ?>
</head>
<body>
<section class="header">
        <?php
            include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
        ?>
        <!-- ----------------- OTP Verification ----------------------- -->
        <div class="container">
            <div class="card">
                <div class="inner-box" id="card">
                    <!-- Check OTP -->
                    <div class="card-front">
                        <h2>Check OTP</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $email ; ?>" name="email">
                            <span>OTP has been sent to </span>
                            <span><?php echo $email; ?></span>
                            <input type="number" name="otp" class="input-box" placeholder="Enter OTP..." required>
                            <input type="password" name="pass" class="input-box" placeholder="Enter New Password..." required>
                            <button type="submit" name="passsubmit" class="submit-btn">SET NEW PASSWORD</button>
                        </form>
                        <a href="login.php">Back To Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>