<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';

    if(isset($_POST['submitCutoff'])){
        $c_id = $_POST['c_id'];
        $stream_id = $_POST['stream_id'];
        $year = $_POST['c_year'];
        $cutoff = $_POST['cutoff'];

        $sql = "UPDATE addStream SET year = '$year', cutoff = '$cutoff' WHERE c_id = '$c_id' AND stream_id = '$stream_id'";

        $result = mysqli_query($con, $sql);

        if ($result){
            echo "<script>alert('Cut-off added to database successfully')</script>";
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
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;1,600;1,700&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>College Admission Prediction</title>
</head>
<body>
    <section class="sub-header">
        <nav>
            <a href="index.html"><h3 class="logo-text">College Admission Prediction</h3></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="addCollege.php">ADD COLLEGE</a></li>
                    <li><a href="addStream.php">ADD COLLEGE STREAM</a></li>
                    <li><a href="addCutoff.php">ADD CUTOFF</a></li>
                    <li><a href="">VIEW COLLEGE</a></li>
                    <li><a href="">VIEW STUDENT</a></li>
                    <li><a href="">VIEW FEEDBACK</a></li>
                    <li><a href="admin.php">LOGOUT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <h1>Add Stream</h1>

    </section>

    <section>
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <select onchange=check() name="c_id" id="checkcollege" >
                    <option disabled selected value="">-- Select College --</option>
                    <?php
                        $record = mysqli_query($con,"SELECT * FROM addcollege");
                        while($data = mysqli_fetch_array($record)){
                            echo "<option value='". $data['c_id'] ."'>" .$data['c_name'] ."</option>"; 
                        }
                    ?>
                </select>
            </div>
            <div>
                <select name="stream_id" id="cstream">
                    <option disabled selected value="">-- Select Stream --</option>
                </select>
            </div>
            <div>
                <div>
                    <label for="">Year: </label>
                </div>
                <input type="number" min="2019" max="2021" name="c_year" placeholder="Year" required>
            </div>
            <div>
                <div>
                    <label for="">Cut-Off: </label>
                </div>
                <input type="number" min="40" max="100" name="cutoff" placeholder="Cut-Off" required>
            </div>

            <div>
                <button type="submit" name="submitCutoff">Add Cut-Off</button>
            </div>
        </form>
    </section>

    <!-- --------JavaScript for toogle button-------- -->
    <script>

        var navLinks = document.getElementById("navLinks");

        function showMenu(){
            navLinks.style.right = "0";
        }
        function hideMenu(){
            navLinks.style.right = "-200px";
        }
        function check(){

            var c_id = document.getElementById("checkcollege").value;
            // console.log(c_id);
            $.ajax({
                url : "checkStream.php?c_id="+c_id,
                    success:function(response){
                        // console.log(response);
                        $("#cstream").html(response);
                    }
            })

        };
        

    </script>

</body>
</html>