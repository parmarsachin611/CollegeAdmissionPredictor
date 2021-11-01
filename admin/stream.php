<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}

if (isset($_POST['addStream'])){
    $stName = mysqli_real_escape_string($con,trim($_POST['stream']));        
    $stActive = mysqli_real_escape_string($con,$_POST['active']);

    $sql = "SELECT * FROM stream WHERE st_name = '$stName'";
    $result = mysqli_query($con,$sql);


    if (!$result -> num_rows>0){
        $sql = "INSERT INTO stream(st_name,active)
        VALUES('$stName','$stActive')";

    $result = mysqli_query($con, $sql);
    if ($result){
        echo "<script>alert('Stream added to database sucessfully')</script>";
    }

    else{
        echo "<script>alert('Something went wrong.')</script>";
    }

            
    }

    else{
    
        echo "<script>alert('Stream Already Exists.')</script>";
}
}

if (isset($_POST['updateSt'])){
$stId = mysqli_real_escape_string($con,$_POST['stId']);

$sql = "SELECT * FROM stream WHERE st_id = '$stId'";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){

$row = mysqli_fetch_assoc($result);
$active=$row['active'];

if($active==1){
  $updatedactive=0;
}else{
$updatedactive=1;
}

$sql = "UPDATE stream SET active=$updatedactive WHERE st_id=$stId";
$result = mysqli_query($con,$sql);
if($result){
echo "<script type='text/javascript'>
alert('Stream updated.');
  window.location='./stream.php';
   </script>";
}else{
echo "<script type='text/javascript'>
alert('Try Again.');
  window.location='./stream.php';
   </script>";
}

}else{
echo "<script type='text/javascript'>
alert('No such stream.');
window.location='./stream.php';
 </script>";
}
}

if(isset($_POST['deleteSt'])){
$stId = mysqli_real_escape_string($con,$_POST['stId']);

$sql = "DELETE FROM stream WHERE st_id=$stId";

if ($con->query($sql) === TRUE) {
echo "<script type='text/javascript'>
alert('Stream Deleted.');
  window.location='./stream.php';
   </script>";
} else {
echo "<script type='text/javascript'>
alert('Try Again.');
  window.location='./stream.php';
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
    <title>Add Stream | College Admission Predictor</title>
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
        <h1>ADD STREAM</h1>
    </div>
</section>

<div class="tabs" id="tab">
<h1>ADD STREAM</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>ADD STREAM</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="stream">Add Stream Name:</label>
            <input type="text" name="stream" placeholder="Enter Stream Name..." required>
        </div>
        <div class="col">
            <label for="active"><input type="radio" name="active" value="1" required> Active</label>
            <label for="active"><input type="radio" name="active" value="0" required> Inactive</label>
        </div>
    </div>
    <input type="submit" class="hero-btn1" name="addStream"  value="Add Stream">
    </form>
    <br>
    <h3>STREAM TABLE</h3>


    <table class = "display-table" id="example">
    <thead>
                <th scope="col">Stream ID</th>
                <th scope="col">Stream Name</th>
                <th scope="col">Stream Active</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
    </thead>
            <tbody>
                
                <?php
                    $records = mysqli_query($con, "SELECT * From stream");

                    while($data = mysqli_fetch_array($records))
                    {
                        $actDis = '';
                        if ($data['active'] == 0){
                          $actDis = 'Inactive';
                        }
                        else {
                          $actDis = 'Active';
                        }
                        echo "<tr>";
                        echo "<td value='". $data['st_id'] ."'>" .$data['st_id'] ."</td>";
                        echo "<td value='". $data['st_name'] ."'>" .$data['st_name'] ."</td>";
                        echo "<td value='". $actDis ."'>" .$actDis ."</td>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['st_id']." name='stId'>
                                <input type='submit' class='hero-btn2' name='updateSt' value='Update'>
                            </form></td>";
                            
                        "</tr>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['st_id']." name='stId'>
                                <input type='submit' class='hero-btn2' name='deleteSt' value='Delete'>
                            </form></td>";
                            
                        echo "</tr>";
                        
                    }	
                ?>  
            </tbody>
    </table>


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