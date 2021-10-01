<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';


if (isset($_SESSION['sid'])) {

    $sid = $_SESSION['sid'];
    $query = "SELECT * FROM student WHERE sid ='$sid'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $name = $fname." ".$lname;

}
else {
  header("Location: studlogin.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '..\includes\_links.php';?>
    <title>Home | College Admission Prediction</title>
</head>
<body>
    <section class="header">
        <?php include '..\includes\_navbar.php';?>
        <div class="text-box">
            <h1>Welcome, <?php echo $name;?></h1>
        </div>
    </section>
</body>
</html>