<?php 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}
$cid = mysqli_real_escape_string($con,$_POST['cId']);

if (isset($_POST['update_Cutoff'])) {
    $cId = mysqli_real_escape_string($con,$_POST['cid']);
    $cutoff = mysqli_real_escape_string($con,trim($_POST['cutoff']));
    $sql5 = mysqli_query($con,"UPDATE cutoff SET cutoff = '$cutoff' WHERE c_id = '$cId'");
    if ($sql5){
        echo "<script>alert('Cutoff updated to database sucessfully');
        window.location='./cutoff.php';
        </script>";
    }

    else{
        echo "<script>alert('Something went wrong.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cutoff | College Admission Predictor</title>
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
        <h1>UPDATE CUTOFF</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>UPDATE CUTOFF</h3>
    <?php
    
    $sql = mysqli_query($con,"SELECT * FROM cutoff WHERE c_id = '$cid'");
    $data = mysqli_fetch_assoc($sql);
    $result = mysqli_query($con,"SELECT * From stream where st_id=".$data['st_id']);
    $row = mysqli_fetch_array($result);
    $st_Name = $row['st_name'];
    $result1 = mysqli_query($con,"SELECT * From institute where inst_id=".$data['inst_id']);
    $row1 = mysqli_fetch_array($result1);
    $inst_Name = $row1['inst_name'];
    $result2 = mysqli_query($con,"SELECT * From branch where b_id=".$data['b_id']);
    $row2 = mysqli_fetch_array($result2);
    $b_name = $row2['b_name'];
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="">College:</label>
            <h3><?php echo $inst_Name; ?></h3>
        </div>
        <div class="col">
            <label for="">Stream:</label>
            <h3><?php echo $st_Name; ?></h3>
        </div>
        <div class="col">
            <label for="">Branch:</label>
            <h3><?php echo $b_name; ?></h3>
        </div>
        <div class="col">
            <label for="cutoff">Add Cutoff:</label>
            <br>
            <input type="hidden" name="cid" value = "<?php echo $cid; ?>">
            <input style="margin-top: 15px;" type="number" min=40 max=100 name="cutoff" placeholder="Enter Cutoff..." required>
        </div>
    </div>
    <input type="submit" class="hero-btn1" name="update_Cutoff"  value="Add Cutoff">
    </form>
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