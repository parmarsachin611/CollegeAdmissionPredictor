<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}
if (isset($_POST['addInstitute'])){
    $inName = mysqli_real_escape_string($con,trim($_POST['institute']));               
    $uID = mysqli_real_escape_string($con,$_POST['uid']);        
    $inActive = mysqli_real_escape_string($con,$_POST['active']);

    $sql = "SELECT * FROM institute WHERE inst_name = '$inName' AND u_id = '$uID'";
    $result = mysqli_query($con,$sql);

    if (!$result -> num_rows>0){
        $sql = "INSERT INTO institute(u_id,inst_name,active)
        VALUES('$uID','$inName','$inActive')";

    $result = mysqli_query($con, $sql);
    if ($result){
        echo "<script>alert('Institute added to database sucessfully')</script>";
    }

    else{
        echo "<script>alert('Something went wrong.')</script>";
    }

        
    }
    else{
    
        echo "<script>alert('Institute Already Exists.')</script>";
}
}

if(isset($_POST['updateInst'])){
$instId = mysqli_real_escape_string($con,$_POST['instId']);

$sql = "SELECT * FROM institute WHERE inst_id = '$instId'";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){

$row = mysqli_fetch_assoc($result);
$active=$row['active'];

if($active==1){
    $updatedactive=0;
}else{
  $updatedactive=1;
}

$sql = "UPDATE institute SET active=$updatedactive WHERE inst_id=$instId";
$result = mysqli_query($con,$sql);
if($result){
  echo "<script type='text/javascript'>
  alert('Institute updated.');
    window.location='./institute.php';
     </script>";
}else{
  echo "<script type='text/javascript'>
  alert('Try Again.');
    window.location='./institute.php';
     </script>";
}

}else{
echo "<script type='text/javascript'>
alert('No such institute.');
  window.location='./institute.php';
   </script>";
}
}

if(isset($_POST['deleteInst'])){
$instId = mysqli_real_escape_string($con,$_POST['instId']);

$sql = "DELETE FROM institute WHERE inst_id=$instId";

if ($con->query($sql) === TRUE) {
  echo "<script type='text/javascript'>
  alert('Institute Deleted.');
    window.location='./institute.php';
     </script>";
} else {
  echo "<script type='text/javascript'>
  alert('Try Again.');
    window.location='./institute.php';
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
    <title>Add Institute | College Admission Predictor</title>
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
        <h1>ADD INSTITUTE</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>ADD INSTITUTE</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="institute">Add Institute Name:</label>
            <input type="text" name="institute" placeholder="Enter Institute Name..." required>
        </div>
        <div class="col">
            <label for="active"><input type="radio" name="active" value="1" required> Active</label>
            <label for="active"><input type="radio" name="active" value="0" required> Inactive</label>
        </div>
    </div>
    <div class="row">
    <div class="col">
    <label for='uid'>Select University:</label>
        <select name='uid'required>
            <option value='' disabled selected >Select University Name</option>
                <?php 
                    $records = mysqli_query($con, "SELECT * From university WHERE active = '1'");

                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['u_id'] ."'>" .$data['u_name'] ."</option>";
                    }	
                ?>  
        </select>
        </div>
        </div>
        <input type="submit" class="hero-btn1" name="addInstitute"  value="Add Institute">
    </form>
    <br>
    <h3>INSTITUTE TABLE</h3>


    <table class = "display-table">
    <thead>
        
                <th scope="col">Institute ID</th>
                <th scope="col">University Name</th>
                <th scope="col">Institute Name</th>
                <th scope="col">Institute Active</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
        
    </thead>
            <tbody>
                
                <?php
                    $records = mysqli_query($con, "SELECT * From institute");

                    while($data = mysqli_fetch_array($records))
                    {
                        $actDis = '';
                        if ($data['active'] == 0){
                          $actDis = 'Inactive';
                        }
                        else {
                          $actDis = 'Active';
                        }

                        $uSql = "SELECT * FROM university WHERE u_id = ".$data['u_id'];
                        $uIDres = mysqli_query($con,$uSql);

                        if ($uIDres->num_rows >0){
                            $row = mysqli_fetch_assoc($uIDres);
                            $uName = $row['u_name'];
                        }

                        echo "<tr>";
                        echo "<td value='". $data['inst_id'] ."'>" .$data['inst_id'] ."</td>";
                        echo "<td value='". $data['u_id'] ."'>" .$uName ."</td>";
                        echo "<td value='". $data['inst_name'] ."'>" .$data['inst_name'] ."</td>";
                        echo "<td value='". $actDis ."'>" .$actDis ."</td>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['inst_id']." name='instId'>
                                <input type='submit'  class='hero-btn2' name='updateInst' value='Update'>
                            </form></td>";
                            
                      
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['inst_id']." name='instId'>
                                <input type='submit' class='hero-btn2' name='deleteInst' value='Delete'>
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