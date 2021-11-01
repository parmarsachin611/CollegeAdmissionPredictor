<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}

if (isset($_POST['addBranch'])){
    $stID = mysqli_real_escape_string($con,$_POST['stid']);               
    $bName = mysqli_real_escape_string($con,trim($_POST['branch']));        
    $bActive = mysqli_real_escape_string($con,$_POST['active']);

    $sql = "SELECT * FROM branch WHERE b_name = '$bName' AND st_id ='$stID'";
    $result = mysqli_query($con,$sql);

    if (!$result -> num_rows>0){
        $sql = "INSERT INTO branch(st_id,b_name,active) VALUES('$stID','$bName','$bActive')";

        $result = mysqli_query($con, $sql);
        if ($result){
            echo "<script>alert('Branch added to database sucessfully')</script>";
        }

        else{
            echo "<script>alert('Something went wrong.')</script>";
        }

        
    }
    else{
    
        echo "<script>alert('Branch Already Exists.')</script>";
}
}

if(isset($_POST['updateBr'])){
$brId = mysqli_real_escape_string($con,$_POST['bId']);

$sql = "SELECT * FROM branch WHERE b_id = '$brId'";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){

$row = mysqli_fetch_assoc($result);
$active=$row['active'];

if($active==1){
    $updatedactive=0;
}else{
  $updatedactive=1;
}

$sql = "UPDATE branch SET active=$updatedactive WHERE b_id=$brId";
$result = mysqli_query($con,$sql);
if($result){
  echo "<script type='text/javascript'>
  alert('Branch updated.');
    window.location='./branch.php';
     </script>";
}else{
  echo "<script type='text/javascript'>
  alert('Try Again.');
    window.location='./branch.php';
     </script>";
}

}else{
echo "<script type='text/javascript'>
alert('No such branch.');
  window.location='./branch.php';
   </script>";
}
}

if(isset($_POST['deleteBr'])){
$brId = mysqli_real_escape_string($con,$_POST['bId']);

$sql = "DELETE FROM branch WHERE b_id=$brId";

if ($con->query($sql) === TRUE) {
  echo "<script type='text/javascript'>
  alert('Branch Deleted.');
    window.location='./branch.php';
     </script>";
} else {
  echo "<script type='text/javascript'>
  alert('Try Again.');
    window.location='./branch.php';
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
    <title>Add Branch | College Admission Predictor</title>
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
        <h1>ADD BRANCH</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>ADD BRANCH</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="branch">Add Branch Name:</label>
            <input type="text" name="branch" placeholder="Enter Branch Name..." required>
        </div>
        <div class="col">
            <label for="active"><input type="radio" name="active" value="1" required> Active</label>
            <label for="active"><input type="radio" name="active" value="0" required> Inactive</label>
        </div>
    </div>

    <div class="row">
    <div class="col">
    <label for='stid'>Select Stream:</label>
        <select name='stid' required>
            <option value='' disabled selected >Select Stream Name</option>
                <?php 
                    $records = mysqli_query($con, "SELECT * From stream WHERE active = '1'");

                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['st_id'] ."'>" .$data['st_name'] ."</option>";
                    }	
                ?>  
        </select>
        </div>
        </div>
    <input type="submit" class="hero-btn1" name="addBranch"  value="Add Branch">
    </form>
    <br>
    <h3>BRANCH TABLE</h3>


    <table class = "display-table">
        
    <thead>
                <th scope="col">Branch ID</th>
                <th scope="col">Stream Name</th>
                <th scope="col">Branch Name</th>
                <th scope="col">Branch Active</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
    </thead>
            <tbody>

                <?php
                    $records = mysqli_query($con, "SELECT * From branch ORDER BY st_id");

                    while($data = mysqli_fetch_array($records))
                    {
                        $actDis = '';
                        if ($data['active'] == 0){
                          $actDis = 'Inactive';
                        }
                        else {
                          $actDis = 'Active';
                        }
                        $result = mysqli_query($con,"SELECT * From stream where st_id=".$data['st_id']);
                        $row = mysqli_fetch_array($result);
                        $st_Name = $row['st_name'];
                        
                        echo "<tr>";
                        echo "<td value='". $data['b_id'] ."'>" .$data['b_id'] ."</td>";
                        echo "<td value='". $data['st_id'] ."'>" .$st_Name."</td>";
                        echo "<td value='". $data['b_name'] ."'>" .$data['b_name'] ."</td>";
                        echo "<td value='". $actDis ."'>" .$actDis ."</td>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['b_id']." name='bId'>
                                <input type='submit' class='hero-btn2' name='updateBr' value='Update'>
                            </form></td>";
                            
                        "</tr>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['b_id']." name='bId'>
                                <input type='submit' class='hero-btn2' name='deleteBr' value='Delete'>
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
<!-- <script>
    // To Get Institute Dropdown

    // function checkinstitute(){
    //     var u_id = document.getElementById("universitygroup").value;
    //     $.ajax({
    //         url : "getInstitute.php?u_id="+u_id,
    //         success:function(response){
    //             console.log(response);
    //             $("#institutegroup").html(response);
    //         }
    //     })
    // };
</script> -->
</body>
</html>