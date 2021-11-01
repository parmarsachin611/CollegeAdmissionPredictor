<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}

if (isset($_POST['addUniversity'])){
    $uName = mysqli_real_escape_string($con,$_POST['university']);        
    $uActive = mysqli_real_escape_string($con,$_POST['active']);

    $sql = "SELECT * FROM university WHERE u_name = '$uName'";
    $result = mysqli_query($con,$sql);


    if (!$result -> num_rows>0){
        $sql = "INSERT INTO university(u_name,active)
        VALUES('$uName','$uActive')";

        $result = mysqli_query($con, $sql);
        if ($result){
            echo "<script>alert('University added to database sucessfully')</script>";
        }else{
        echo "<script>alert('Something went wrong.')</script>";
        }
    }
    else{
        echo "<script>alert('University Already Exists.')</script>";
    }

}
if(isset($_POST['updateuniv'])){
    $univid = mysqli_real_escape_string($con,$_POST['u_id']);
  
    $sql = "SELECT * FROM university WHERE u_id = '$univid'";
    $result = mysqli_query($con,$sql);
    
   if(mysqli_num_rows($result)>0){
  
    $row = mysqli_fetch_assoc($result);
    $active=$row['active'];
  
    if($active==1){
        $updatedactive=0;
    }else{
      $updatedactive=1;
    }
  
    $sql = "UPDATE university SET active=$updatedactive WHERE u_id=$univid";
    $result = mysqli_query($con,$sql);
    if($result){
      echo "<script type='text/javascript'>
      alert('University updated.');
        window.location='./university.php';
         </script>";
    }else{
      echo "<script type='text/javascript'>
      alert('Try Again.');
        window.location='./university.php';
         </script>";
    }
  
   }else{
    echo "<script type='text/javascript'>
    alert('No such university.');
      window.location='./university.php';
       </script>";
   }
  }
  
  if(isset($_POST['deleteuniv'])){
    $univid = mysqli_real_escape_string($con,$_POST['u_id']);
  
    $sql = "DELETE FROM university WHERE u_id=$univid";
  
    if ($con->query($sql) === TRUE) {
      echo "<script type='text/javascript'>
      alert('University Deleted.');
        window.location='./university.php';
         </script>";
    } else {
      echo "<script type='text/javascript'>
      alert('Try Again.');
        window.location='./university.php';
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
    <title>Add University | College Admission Predictor</title>
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
        <h1>ADD UNIVERSITY</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>ADD UNIVERSITY</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="university">Add University Name:</label>
            <input type="text" name="university" placeholder="Enter University Name..." required>
        </div>
        <div class="col">
            <label for="active"><input type="radio" name="active" value="1" required> Active</label>
            <label for="active"><input type="radio" name="active" value="0" required> Inactive</label>
        </div>
    </div>
    <input type="submit" class="hero-btn1" name="addUniversity"  value="Add University">
    </form>
    <br>
    <h3>UNIVERSITY TABLE</h3>


    <table class = "display-table">
    <thead>
           
                <th scope="col">University ID</th>
                <th scope="col">University Name</th>
                <th scope="col">University Active</th>
                <th scope="col">Update</th>
                <th scope="col">Delete</th>
            
        </thead>
        <tbody>          
                
                <?php
                    $records = mysqli_query($con, "SELECT * From university");

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
                        echo "<td>" .$data['u_id'] ."</td>";
                        echo "<td>" .$data['u_name'] ."</td>";
                        echo "<td>" .$actDis ."</td>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['u_id']." name='u_id'>
                                <input type='submit' class='hero-btn2' name='updateuniv' value='Update'>
                            </form></td>";
                        echo "<td><form action='' method='POST'>
                                <input type='hidden' value=".$data['u_id']." name='u_id'>
                                <input type='submit' class='hero-btn2' name='deleteuniv' value='Delete'>
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