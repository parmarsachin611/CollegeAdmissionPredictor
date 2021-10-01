<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';

    if(isset($_POST['submitCollege'])){
        $c_name = $_POST['c_name'];
        $c_address = $_POST['c_address'];
        $c_city =$_POST['c_city'];
        $c_zip = $_POST['c_zip'];
        $c_contact = $_POST['c_contact'];

        $sql = "SELECT * FROM addcollege WHERE c_name = '$c_name'";
        $result = mysqli_query($con,$sql);

        if (!$result -> num_rows>0){
            $sql = "INSERT INTO addcollege(c_name,c_address,c_city,c_zip,c_contact)
            VALUES('$c_name','$c_address','$c_city','$c_zip','$c_contact')";

        $result = mysqli_query($con, $sql);

        if ($result){
            echo "<script>alert('College added to database successfully')</script>";
        }
        else{
            echo "<script>alert('Something went wrong.')</script>";
        }            
        }
            else{
                echo "<script>alert('College Already Exists.')</script>";
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
    <link rel="stylesheet" href="../css/admincss.css">
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
                    <li><a href="/index.html">ADD COLLEGE</a></li>
                    <li><a href="addStream.php">ADD COLLEGE STREAM</a></li>
                    <li><a href="">ADD CUTOFF</a></li>
                    <li><a href="">VIEW COLLEGE</a></li>
                    <li><a href="">VIEW STUDENT</a></li>
                    <li><a href="">VIEW FEEDBACK</a></li>
                    <li><a href="">LOGOUT</a></li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <h1>Add College</h1>

    </section>

    <section>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <div>
                    <label for="">College Name: </label>
                </div>
                <input type="text" name="c_name" placeholder="College Name" required>
            </div>
            <div>
                <div>
                    <label for="">Address: </label>
                </div>
                <input type="text" name="c_address" placeholder="Address" required>
            </div>
            <div>
                <div>
                    <label for="">City: </label>
                </div>
                <input type="text" name="c_city" placeholder="City" required>
            </div>
            <div>
                <div>
                    <label for="">Zip Code: </label>
                </div>
                <input type="text" name="c_zip" placeholder="Zip Code" required>
            </div>
            <div>
                <div>
                    <label for="">Contact No: </label>
                </div>
                <input type="text" name="c_contact" placeholder="Contact No." required>
            </div>
            <div>
                <button type="submit" name="submitCollege">Add College</button>
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