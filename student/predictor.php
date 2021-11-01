<?php

// INCLUDE DATABASE CONNECTION 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['sid'])) {
    $sid = $_SESSION['sid'];
}else {
    header("Location: ./login.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predict College | College Admission Predictor</title>
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
        <h1>PREDICT COLLEGE</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>PREDICT COLLEGE</h3>
    <form action="result.php" enctype="multipart/form-data" method="post">
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
            <label for="cutoff">Enter HSC %:</label>
            <input type="number" min=40 max=100 name="cutoff" placeholder="Enter Cutoff..." required>
        </div>
    </div>
    <input type="submit"  class="hero-btn1" name="setBr"  value="PREDICT">
    </form>
    
    <script>


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
<a style="margin-left: 345px;" href="./home.php" class="hero-btn2">BACK</a>
</div>
    <?php   
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>
</body>
</html>