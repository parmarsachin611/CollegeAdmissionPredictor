<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';
    if (isset($_POST['submitpass'])) {
        $email = mysqli_real_escape_string($con,trim($_POST['email']));
        $game = mysqli_real_escape_string($con,trim($_POST['game']));
        $pass = mysqli_real_escape_string($con,trim($_POST['password']));
        $query = "SELECT * FROM student WHERE email = '$email'";
        $record = mysqli_query($con,$query);
        
        if ($record -> num_rows>0){
                $row = mysqli_fetch_assoc($record);
                $dgame = $row['game'];
                if ($dgame == $game) {
                    $secure = 99;
                    if( strlen($pass)<8){
                        $secure = 1;
                        echo "<script>alert('Password must be more than 8.');</script>";
                    }
                    elseif(!preg_match("/^(?=.*[0-9])(?=.*[!@#$%.^&*])[a-zA-Z0-9!@#$._\-%^&*]{8,}$/",$pass)  ){
                        $secure = 2;
                        echo "<script>alert('Password must have A-Z,0-9 & Special Character');</script>";
                    }

                    // After Validation, Password will reset
                    if($secure == 99){
                        $cpass = password_hash($pass, PASSWORD_BCRYPT);
                        $sql = "UPDATE student SET password = '$cpass' WHERE game = '$game'";
                        $result = mysqli_query($con,$sql);
                        if ($result) {
                            echo "<script>
                                    alert('Password Reset Successfull.');
                                    window.location='studlogin.php';
                                  </script>";
                        }
                        else{
                            echo "<script>alert('Something went wrong.');</script>";
                        } 
                    }
                }
                else
                {
                    echo "<script>
                            alert('Game name and account does not match.');
                          </script>";
                }
                
            
        }
        else{
            echo "<script>alert('Account does not exist.');</script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '..\includes\_links.php';?>
    <title>Password Reset | College Admission Prediction</title>
</head>

<body>
    <section class="header">
        <?php include '..\includes\_navbar.php';?>
        <!-- -----------------PASSWORD RESET----------------------- -->
        <div class="container">
            <div class="card">
                <div class="inner-box" id="card">
                    <!-- PASSWORD RESET -->
                    <div class="card-front">
                        <h2>PASS-RESET</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="email" name="email" class="input-box" placeholder="Your Email Id"  required>
                            <input type="text" name="game" class="input-box" placeholder="Your Favourite Game"  required>
                            <input type="password" name="password" class="input-box" placeholder="Password" required>
                            <button type="submit" name="submitpass" class="submit-btn">CHANGE PASSWORD</button>
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

        // Login and register

        var card = document.getElementById("card");

        function openRegister() {
            card.style.transform = "rotateY(-180deg)";
        }
        function openLogin() {
            card.style.transform = "rotateY(0)";
        }
    </script>

</body>

</html>