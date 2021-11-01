<?php
    // INCLUDE DATABASE CONNECTION 
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';

    // LOGIN BUTTON
    if(isset($_POST['submit'])){

        $email = mysqli_real_escape_string($con,trim($_POST['email']));
        $query = "SELECT * FROM student WHERE email='$email'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
        $sid = $row['sid'];
        $pass = $row['password'];
        $password = mysqli_real_escape_string($con,trim($_POST['password']));
        
        // Validation
        $secure = 99;
  
        if($email == "" || $password == ""){
            $secure = 0;
        }
        else if( strlen($password)<8){
            $secure = 1;
        }
        else if(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%.^&*])[a-zA-Z0-9!@#$._\-%^&*]{8,}$/",$password) || !preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email) ){
            $secure = 2;
        }
    
        if($secure == 99){
            if (password_verify($password, $pass)) {
                session_start();
                $_SESSION['sid'] =  $sid;
                header("Location: home.php");
            }
            else {
                echo "
                <script>
                    alert('Invalid Credentials.');
                    window.location='login.php';
                </script>";
            }
        }
        else {
            echo "
            <script>
                alert('Enter Valid Data.');
                window.location='login.php';
            </script>";
        }
    }

//     // REGISTER BUTTON
//     if (isset($_POST['submitRegister'])){
//         $fname = mysqli_real_escape_string($con,trim($_POST['fname']));        
//         $lname = mysqli_real_escape_string($con,trim($_POST['lname']));        
//         $email = mysqli_real_escape_string($con,trim($_POST['email']));        
//         $phone = mysqli_real_escape_string($con,trim($_POST['phone']));        
//         $pass = mysqli_real_escape_string($con,trim($_POST['password']));                
//         $game = mysqli_real_escape_string($con,trim($_POST['game']));  
        

//         $sql = "SELECT * FROM student WHERE email = '$email'";
//         $result = mysqli_query($con,$sql);
        
//         // Checking if email already exists or not
//         if (!$result -> num_rows>0){

//             // Validation
//             $secure = 99;

//             if($email=="" || $pass == ""){
//                 $secure = 0;
//                 echo "<script>alert('Enter Email and Password.')</script>";
//             }
//             elseif( strlen($pass)<8){
//                 $secure = 1;
//                 echo "<script>alert('Password must be more than 8.')</script>";
//             }
//             elseif(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%.^&*])[a-zA-Z0-9!@#$._\-%^&*]{8,}$/",$pass)  ){
//                 $secure = 2;
//                 echo "<script>alert('Password must have A-Z,0-9 & Special Character')</script>";
//             }
//             elseif(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email)){
//                 $secure = 3;
//                 echo "<script>alert('Invalid Email');</script>";
//             }
//             else if(!preg_match("/^([a-zA-Z' ]+)$/",$fname) ||!preg_match("/^([a-zA-Z' ]+)$/",$lname)){
//                 $secure = 4;
//                 echo "<script>alert('Invalid Name')</script>";
//             }
//             elseif(!preg_match('/^[0-9]{10}$/', $phone)){
//                 $secure = 5;
//                 echo "<script>alert('Invalid Phone Number')</script>";
//             }

//             // After Validation, Student data will get inserted in database
//             if($secure == 99){

//                 // Password Encryption
//                 $cpass = password_hash($pass, PASSWORD_BCRYPT);
//                 // Insert Query
//                 $query = "INSERT INTO `student`(`fname`, `lname`, `email`, `phone`, `password`, `game`) VALUES ('$fname','$lname','$email','$phone','$cpass','$game')";
//                 $record = mysqli_query($con,$query);
//                 if ($record) {
//                     echo "<script>alert('User Registeration Completed.')</script>";
//                 }
//                 else{
//                     echo "<script>alert('Something went wrong.')</script>";
//                 } 

//             }

//         }
//         else{
//             echo "<script>alert('Email Already Exists.')</script>";
//         }
   
// }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | College Admission Predictor</title>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'links.php';
    ?>
</head>
<body>
    <section class="header">
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
    ?>
    <!-- -----------------LOGIN & REGISTERATION----------------------- -->
    <div class="container">
        <div class="card">
            <div class="inner-box" id="card">
                <!-- LOGIN -->
                <div class="card-front">
                    <h2>STUD-LOGIN</h2>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="email" name="email" class="input-box" placeholder="Your Email Id"  required>
                        <input type="password" name="password" class="input-box" placeholder="Password" required>
                        <button type="submit" name="submit" class="submit-btn">LOGIN</button>
                    </form>
                    <button type="button" class="btn" onclick="openRegister()">I'm New Here</button>
                    <a href="passwordreset.php">Forget Password</a>
                </div>
                <!-- REGISTER -->
                <div class="card-back">
                    <h2>STUD-REGISTER</h2>
                    <form action="./otpcheck.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="fname" class="input-box" placeholder="Enter Your First Name" required>
                        <input type="text" name="lname" class="input-box" placeholder="Enter Your Last Name" required>
                        <input type="email" id="email" name="email" class="input-box" placeholder="Enter Your Email Id" required>
                        <input type="number" name="phone" class="input-box" placeholder="Enter Your Phone Number" required>
                        <input type="password" name="password" class="input-box" placeholder="Enter Your Password" required>
                        <button type="submit" name="submitRegister" class="submit-btn">REGISTER</button>
                    </form>
                    <button type="button" class="btn up" onclick="openLogin()">I've an account</button>
                </div>
            </div>
        </div>
    </div>
    </section>

    <script>

        // Login and register

        var card = document.getElementById("card");

        function openRegister() {
            card.style.transform = "rotateY(-180deg)";
        }
        function openLogin() {
            card.style.transform = "rotateY(0)";
        }

    </script>
    <script>
        function getOTP {
            var email = document.getElementById("email").value;
            $.ajax({
	        
                url : 'controller.php?email'=+email,
               
                success : function(response)
                {
                    alert("Otp sent to email id");
                    
                },
                
                
            });
        }
    </script>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>
</body>
</html>