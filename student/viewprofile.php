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
$name = $res['fname']." ".$res['lname'];
$email = $res['email'];
$phone = $res['phone'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile | College Admission Predictor</title>
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
        <h1>View Profile</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>VIEW PROFILE</h3>
    <div class="row">
        <div class="col">
            <label for="">Name: </label>
            <h4><?php echo $name; ?></h4>
        </div>
        <div class="col">
            <label for="">Email: </label>
            <h4><?php echo $email; ?></h4>
        </div>
        <div class="col">
            <label for="">Phone: </label>
            <h4><?php echo $phone; ?></h4>
        </div>
    </div>
    <br>
<a style="margin-left: 382px;" href="./home.php" class="hero-btn2">BACK</a>
</div>
<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
?>
<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>
</body>
</html>