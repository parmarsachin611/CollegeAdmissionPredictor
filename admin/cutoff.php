<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}

if (isset($_POST['addCutoff'])){
                  
    $instID = mysqli_real_escape_string($con,$_POST['instid']);               
    $stID = mysqli_real_escape_string($con,$_POST['stid']);               
    $bID = mysqli_real_escape_string($con,$_POST['bid']);               
    $cutoff = mysqli_real_escape_string($con,trim($_POST['cutoff']));        
    

    $sql = "SELECT * FROM cutoff WHERE b_id = '$bID' AND inst_id ='$instID'";
    $result = mysqli_query($con,$sql);

    if (!$result -> num_rows>0){
        $sql = "INSERT INTO `cutoff`( `inst_id`, `st_id`, `b_id`, `cutoff`) VALUES ('$instID','$stID','$bID','$cutoff')";

        $result = mysqli_query($con, $sql);
        if ($result){
            echo "<script>alert('Cutoff added to database sucessfully')</script>";
        }

        else{
            echo "<script>alert('Something went wrong.')</script>";
        }

        
    }
    else{
    
        echo "<script>alert('Cutoff Added Already.')</script>";
    }
}


if(isset($_POST['deleteCutoff'])){
$cId = mysqli_real_escape_string($con,$_POST['cId']);

$sql = "DELETE FROM cutoff WHERE c_id=$cId";

if ($con->query($sql) === TRUE) {
  echo "<script type='text/javascript'>
  alert('Cutoff Deleted.');
    window.location='./home.php';
     </script>";
} else {
  echo "<script type='text/javascript'>
  alert('Try Again.');
    window.location='./home.php';
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
    <title>Add Cutoff | College Admission Predictor</title>

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
        <h1>ADD CUTOFF</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>ADD CUTOFF</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
    <div class="col">
    <label for='uid'>Select University:</label>
        <select name='uid' id="universitygroup" onchange="checkinstitute()" required>
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
    <div class="col">
    <label for='instid'>Select Institute:</label>
        <select id='institutegroup' name='instid' required>
            <option value='' disabled selected >Select Institute Name</option>  
        </select> 
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for='stid'>Select Stream:</label>
        <select name='stid' id="streamgroup" onchange="checkbranch()" required>
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
    <div class="col">
    <label for='bid'>Select Branch:</label>
        <select id='branchgroup' name='bid'required>
            <option value='' disabled selected >Select Branch Name</option>  
        </select> 
    </div>
    </div>
    <div class="row">
    <div class="col">
        <label for="cutoff">Add Cutoff (HSC %):</label>
        <input type="number" min=40 max=100 name="cutoff" placeholder="Enter Cutoff..." required>
    </div>
    </div>
    <input type="submit" class="hero-btn1" name="addCutoff"  value="Add Cutoff">
    </form>
    <script>
    // To Get Institute Dropdown

    function checkinstitute(){
        var u_id = document.getElementById("universitygroup").value;
        $.ajax({
        url : "getinstitute.php?u_id="+u_id,
       
            success:function(response){
                console.log(response);
                $("#institutegroup").html(response);
            }
        })
    };

    // To Get Branch Dropdown

    function checkbranch(){
        var st_id = document.getElementById("streamgroup").value;
        $.ajax({
        url : "getBranch.php?st_id="+st_id,
       
            success:function(response){
                console.log(response);
                $("#branchgroup").html(response);
            }
        })
    };
    
   
</script>
    <br>
    <h3>CUTOFF TABLE</h3>
            

    <table class = "display-table">
        
    <thead>
                <th scope="col">Institute ID</th>
                <th scope="col">College Name</th>
                <th scope="col">Stream Name</th>
                <th scope="col">Branch Name</th>
                <th scope="col">Cutoff</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
    </thead>
            <tbody>

                <?php
                    $records = mysqli_query($con, "SELECT * From cutoff ORDER BY inst_id");

                    while($data = mysqli_fetch_array($records))
                    {
                        
                        $result = mysqli_query($con,"SELECT * From stream where st_id=".$data['st_id']);
                        $row = mysqli_fetch_array($result);
                        $st_Name = $row['st_name'];
                        $result1 = mysqli_query($con,"SELECT * From institute where inst_id=".$data['inst_id']);
                        $row1 = mysqli_fetch_array($result1);
                        $inst_Name = $row1['inst_name'];
                        $result2 = mysqli_query($con,"SELECT * From branch where b_id=".$data['b_id']);
                        $row2 = mysqli_fetch_array($result2);
                        $b_name = $row2['b_name'];
                        
                        echo "<tr>";
                        echo "<td value='". $data['inst_id'] ."'>" .$data['inst_id'] ."</td>";
                        echo "<td value='". $data['inst_id'] ."'>" .$inst_Name."</td>";
                        echo "<td value='". $data['st_id'] ."'>" .$st_Name."</td>";
                        echo "<td value='". $b_name ."'>" .$b_name ."</td>";
                        echo "<td value='". $data['c_id'] ."'>" .$data['cutoff'] ."</td>";
                        echo "<td><form action='updateCutoff.php' method='POST'>
                                <input type='hidden' value=".$data['c_id']." name='cId'>
                                <input type='submit' class='hero-btn2' name='updateCutoff' value='Update'>
                            </form></td>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['c_id']." name='cId'>
                                <input type='submit' class='hero-btn2' name='deleteCutoff' value='Delete'>
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