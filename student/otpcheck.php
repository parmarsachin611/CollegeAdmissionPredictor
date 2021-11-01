<?php

     // INCLUDE DATABASE CONNECTION 
     include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';


    // REGISTER BUTTON
    if (isset($_POST['submitRegister'])){
        $fname = mysqli_real_escape_string($con,trim($_POST['fname']));        
        $lname = mysqli_real_escape_string($con,trim($_POST['lname']));        
        $email = mysqli_real_escape_string($con,trim($_POST['email']));        
        $phone = mysqli_real_escape_string($con,trim($_POST['phone']));        
        $pass = mysqli_real_escape_string($con,trim($_POST['password']));                
        // $game = mysqli_real_escape_string($con,trim($_POST['game']));  
        

        $sql = "SELECT * FROM student WHERE email = '$email'";
        $result = mysqli_query($con,$sql);
        
        // Checking if email already exists or not
        if (!$result -> num_rows>0){

            // Validation
            $secure = 99;

            if($email=="" || $pass == ""){
                $secure = 0;
                echo "<script>alert('Enter Email and Password.');
                window.location='login.php';
                </script>";
            }
            elseif( strlen($pass)<8){
                $secure = 1;
                echo "<script>alert('Password must be more than 8.');
                window.location='login.php';
                </script>";
            }
            elseif(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%.^&*])[a-zA-Z0-9!@#$._\-%^&*]{8,}$/",$pass)  ){
                $secure = 2;
                echo "<script>alert('Password must have A-Z,0-9 & Special Character');
                window.location='login.php';
                </script>";
            }
            elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email)){
                $secure = 3;
                echo "<script>alert('Invalid Email');
                window.location='login.php';
                </script>";
            }
            else if(!preg_match("/^([a-zA-Z' ]+)$/",$fname) ||!preg_match("/^([a-zA-Z' ]+)$/",$lname)){
                $secure = 4;
                echo "<script>alert('Invalid Name');
                window.location='login.php';
                </script>";
            }
            elseif(!preg_match('/^[0-9]{10}$/', $phone)){
                $secure = 5;
                echo "<script>alert('Invalid Phone Number');
                window.location='login.php';
                </script>";
            }

            // After Validation, Student data will get inserted in database
            if($secure == 99){

                $otp = rand(100000, 999999); //generates random otp
                $_SESSION['session_otp'] = $otp;
                $sub = "CAP Registration Email verification";
                $message = "Your one time email verification code is - " . $otp;
                $headers = "From: parmarsachin707@gmail.com";
                // echo $email;
                if(mail($email,$sub,$message,$headers)){
                    echo "<script>alert('OTP sent to email.')
                          </script>";
                }else{
                    echo "<script>alert('Email sending fail....')
                          </script>";
                }
               
                // // Password Encryption
                // $cpass = password_hash($pass, PASSWORD_BCRYPT);
                // // Insert Query
                // $query = "INSERT INTO `student`(`fname`, `lname`, `email`, `phone`, `password`, `game`) VALUES ('$fname','$lname','$email','$phone','$cpass','$game')";
                // $record = mysqli_query($con,$query);
                // if ($record) {
                //     echo "<script>alert('User Registeration Completed.')
                //     </script>";
                // }
                // else{
                //     echo "<script>alert('Something went wrong.')</script>";
                // } 

            }

        }
        else{
            echo "<script>alert('Email Already Exists.');
            window.location='studlogin.php';            
            </script>";
        }
   
}
if(isset($_POST['otpsubmit'])){
    $fname = mysqli_real_escape_string($con,trim($_POST['fname']));        
    $lname = mysqli_real_escape_string($con,trim($_POST['lname']));        
    $email = mysqli_real_escape_string($con,trim($_POST['email']));        
    $phone = mysqli_real_escape_string($con,trim($_POST['phone']));        
    $pass = mysqli_real_escape_string($con,trim($_POST['password']));
    $otp = mysqli_real_escape_string($con,trim($_POST['otp']));
    if ($otp == $_SESSION['session_otp']) {
        unset($_SESSION['session_otp']);
        // Password Encryption
        $cpass = password_hash($pass, PASSWORD_BCRYPT);
        // Insert Query
        $query = "INSERT INTO `student`(`fname`, `lname`, `email`, `phone`, `password`) VALUES ('$fname','$lname','$email','$phone','$cpass')";
        $record = mysqli_query($con,$query);
        if ($record) {
            echo "<script>alert('User Registeration Completed.');
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verfication | College Admission Predictor</title>
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
                            <input type="hidden" value="<?php echo $fname ; ?>" name="fname">
                            <input type="hidden" value="<?php echo $lname ; ?>" name="lname">
                            <input type="hidden" value="<?php echo $email ; ?>" name="email">
                            <input type="hidden" value="<?php echo $phone ; ?>" name="phone">
                            <input type="hidden" value="<?php echo $pass ; ?>" name="password">
                            <span>OTP has been sent to </span>
                            <span><?php echo $email; ?></span>
                            <input type="number" name="otp" class="input-box" placeholder="Enter OTP..." required>
                            <button type="submit" name="otpsubmit" class="submit-btn">REGISTRATION</button>
                        </form>
                        <a href="login.php">Back To Registration</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php echo $email?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>
</body>
</html>