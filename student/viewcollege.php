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
    <title>View College | College Admission Prediction</title>
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
        <h1>View College</h1>
    </div>
</section>
<div class="tabs" id="tab">
    <h3>VIEW COLLEGE</h3>
    <table class="display-table">
        <thead>
                <th scope="col">Sr. No.</th>
                <th scope="col">University </th>
                <th scope="col">Institute </th>
                <th scope="col">Location</th>
                <th scope="col">View</th>
        </thead>
        <tbody>
            <?php 
            
                $no = 1;
                $sql = mysqli_query($con,"SELECT * FROM faculty");
                while ($rec = mysqli_fetch_assoc($sql)) {
                    $inst = $rec['inst_id'];
                    $sql1 = mysqli_query($con,"SELECT * FROM institute WHERE inst_id = '$inst'");
                    $row1 = mysqli_fetch_assoc($sql1);
                    $uid = $row1['u_id'];
                    $inst_name = $row1['inst_name'];
                    $sql2 = mysqli_query($con,"SELECT * FROM university WHERE u_id = '$uid'");
                    $row2 = mysqli_fetch_assoc($sql2);
                    $uName = $row2['u_name'];
                    $city = $rec['inst_city'];
                    $sql3 = mysqli_query($con,"SELECT * FROM city WHERE id = $city");
                    $res1 = mysqli_fetch_array($sql3);
                    $sid = $res1['state_id'];
                    $sql4 = mysqli_query($con,"SELECT * FROM state WHERE id = $sid");
                    $res2 = mysqli_fetch_array($sql4);
                    $loc = $res1['city_name'].",<br> ".$res2['name'];
                    echo "<tr>";
                    echo "<td value='". $no ."'>" .$no ."</td>";
                    echo "<td value='". $uid ."'>" .$uName ."</td>";
                    echo "<td value='". $inst ."'>" .$inst_name ."</td>";
                    echo "<td value='". $loc ."'>" .$loc."</td>";
                    echo "<td><form action='rescollege.php' method='POST'>
                                <input type='hidden' value=".$inst." name='inst'>
                                <input type='submit'  class='hero-btn2' name='viewcollege' value='View'>
                            </form></td>";
                    echo "</tr>";
                    $no=$no+1;
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