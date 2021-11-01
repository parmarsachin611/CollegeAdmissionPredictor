<?php

// INCLUDE DATABASE CONNECTION 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['sid'])) {
    $sid = $_SESSION['sid'];
}else {
    header("Location: ./login.php");
}

$inst = mysqli_real_escape_string($con,$_POST['inst']);
$sql1 = mysqli_query($con,"SELECT * FROM institute WHERE inst_id = '$inst'");
$row1 = mysqli_fetch_assoc($sql1);
$inst_name = $row1['inst_name'];
$sql2 = mysqli_query($con,"SELECT * FROM faculty WHERE inst_id = '$inst'");
$row2 = mysqli_fetch_assoc($sql2);
$fac = $row2['fname'];
$facdesc = $row2['inst_desc'];
$facphone = $row2['inst_phone'];
$facemail = $row2['inst_email'];
$facloc = $row2['inst_city'];
$img = $row2['inst_img'];
$dir = "../images/CollegeImages/".$img;
$sql3 = mysqli_query($con,"SELECT * FROM city WHERE id = $facloc");
$res1 = mysqli_fetch_array($sql3);
$sid = $res1['state_id'];
$sql4 = mysqli_query($con,"SELECT * FROM state WHERE id = $sid");
$res2 = mysqli_fetch_array($sql4);
$loc = $res1['city_name'].", ".$res2['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $inst_name; ?> | College Admission Predictor</title>
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
        <h1><?php echo $inst_name; ?></h1>
    </div>
</section>

<div class="tabs" id="tab">
<h3><?php echo $inst_name; ?></h3>
<div class="col-img">
    <img src="<?php echo $dir; ?>" width="600px" height="600px" alt="College Image">
</div>


<div class="row">
    <div class="col">
        <label for="">Faculty Name:</label>
        <h4><?php echo $fac; ?></h4>
    </div>
    <div class="col">
        <label for="">College Description:</label>
        <h4><?php echo $facdesc; ?></h4>
    </div>
    <div class="col">
        <label for="">Location:</label>
        <h4><?php echo $loc; ?></h4>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for="">Phone No:</label>
        <h4><?php echo $facphone; ?></h4>
    </div> 
    <div class="col" style="margin-left: 118px;">
        <label for="">Email:</label>
        <h4><?php echo $facemail; ?></h4>
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