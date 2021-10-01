<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';

    if(isset($_POST['submitStream'])){
        $c_id = $_POST['c_id'];
        $c_stream = $_POST['c_stream'];

        $sql = "SELECT * FROM addstream WHERE c_id = '$c_id' AND c_stream = '$c_stream'";
        $result = mysqli_query($con,$sql);

        if (!$result -> num_rows>0){
            $sql = "INSERT INTO addstream(c_id,c_stream)
            VALUES('$c_id','$c_stream')";

        $result = mysqli_query($con, $sql);

        if ($result){
            echo "<script>alert('Stream added to database successfully')</script>";
        }
        else{
            echo "<script>alert('Something went wrong.')</script>";
        }            
        }
            else{
                echo "<script>alert('Stream Already Exists.')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <select name="c_id" id="">
                    <option disabled selected value="">-- Select College --</option>
                    <?php
                        $record = mysqli_query($con,"SELECT * FROM addCollege");
                        while($data = mysqli_fetch_array($record)){
                            echo "<option value='". $data['c_id'] ."'>" .$data['c_name'] ."</option>"; 
                        }
                    ?>
                </select>
            </div>
            <div>
                <div>
                    <label for="">Stream Name: </label>
                </div>
                <input type="text" name="c_stream" placeholder="Stream" required>
            </div>
            <div>
                <button type="submit" name="submitStream">Add Stream</button>
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

    </script>

</body>
</html>