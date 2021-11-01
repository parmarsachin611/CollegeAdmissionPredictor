<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
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
    <title>View Student | College Admission Predictor</title>
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
        <h1>View Feedback</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>VIEW FEEDBACK</h3>
    <table class="display-table">
        <thead>
        
                <th scope="col">Student ID</th>
                <th scope="col">Name</th>
                <th scope="col">Feedback</th>
            
        </thead>
        <tbody>
            <?php
                $no = 1;
                $sql = mysqli_query($con,"SELECT * FROM student WHERE feedbackflag = '1'");
                while ($rec = mysqli_fetch_assoc($sql)) {
                    $name = $rec['fname']." ".$rec['lname'];
                    $email = $rec['email'];
                    $feed = $rec['feedback'];
                    $id = $rec['sid'];
                    

                    echo "<tr>";
                    echo "<td value='". $id ."'>" .$id ."</td>";
                    echo "<td value='". $name ."'>" .$name ."</td>";
                    echo "<td value='". $feed ."'>" .$feed ."</td>";
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