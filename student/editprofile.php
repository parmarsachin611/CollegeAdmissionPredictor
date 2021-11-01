<?php 

// INCLUDE DATABASE CONNECTION 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['sid'])) {
    $sid = $_SESSION['sid'];
}else {
    header("Location: ./login.php");
}
$sql = mysqli_query($con,"SELECT * FROM student WHERE sid = '$sid'");
$res = mysqli_fetch_assoc($sql);
$fname = $res['fname'];
$lname = $res['lname'];
$email = $res['email'];
$phone = $res['phone'];
$password  = $res['password'];

if (isset($_POST['updateProfile'])) {
    $fname = mysqli_real_escape_string($con,trim($_POST['fname']));        
    $lname = mysqli_real_escape_string($con,trim($_POST['lname']));        
    $email = mysqli_real_escape_string($con,trim($_POST['email']));        
    $phone = mysqli_real_escape_string($con,trim($_POST['phone']));
    $pass = mysqli_real_escape_string($con,trim($_POST['password']));
    $password = mysqli_real_escape_string($con,trim($_POST['cpassword']));
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

    if ($secure == 99) {
        if (password_verify($pass, $password)) {
            $sql = mysqli_query($con,"UPDATE student SET fname = '$fname', lname = '$lname', email = '$email',phone='$phone' WHERE sid = '$sid'");
            if ($sql){
                echo "<script>alert('Profile updated to database sucessfully')</script>";
            }
            
            else{
                echo "<script>alert('Something went wrong.')</script>";
            }
        }else{
            echo "<script>alert('Password Incorrect.')</script>";
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
    <title>Edit Profile | College Admission Predictor</title>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'links.php';
    ?>
</head>
<body>
<section class="header">
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
    ?>
    <div class="text-box">
        <h1>Edit Profile</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>EDIT PROFILE</h3>
    <form action="" method="post">
    <div class="row">
        <div class="col">
            <label for="fname">First Name: </label>
            <input type="text" name="fname" value="<?php echo $fname ?>">
        </div>
        <div class="col">
            <label for="lname">Last Name: </label>
            <input type="text" name="lname" value="<?php echo $lname ?>">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="email">Email: </label>
            <input type="email" name="email" value="<?php echo $email ?>">
        </div>
    </div>
    <div class="row">
    <div class="col">
            <label for="phone">Phone No: </label>
            <input type="number" name="phone" value="<?php echo $phone ?>">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="password">Password: </label>
            <input type="password" name="password" >
            <input type="hidden" name="cpassword" value="<?php echo $password ?>">
        </div>
    </div>
    
    <input type="submit" class="hero-btn1" name="updateProfile"  value="Update Profile">
    </form>
    <br>
<a style="margin-left: 350px;" href="./home.php" class="hero-btn2">BACK</a>
    </div>
    
<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
?>
<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>
</body>
</html>