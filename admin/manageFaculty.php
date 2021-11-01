<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}

if(isset($_POST['deleteSt'])){
    $fid = mysqli_real_escape_string($con,$_POST['fid']);
    $instid = mysqli_real_escape_string($con,$_POST['instid']);
    $img = mysqli_real_escape_string($con,$_POST['img']);
    $dir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'CollegeImages'.DIRECTORY_SEPARATOR.$img;
    unlink($dir);
    
    $delsql = "DELETE FROM faculty WHERE fid=$fid";
    $upsql = mysqli_query($con,"UPDATE institute SET faculty_flag = '0' WHERE inst_id = '$instid'");
    
    if ($con->query($delsql) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Faculty Deleted.');
      window.location='./manageFaculty.php';
       </script>";
    } else {
    echo "<script type='text/javascript'>
    alert('Try Again.');
      window.location='./managefaculty.php';
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
    <title>Manage Faculty | College Admission Predictor</title>
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
        <h1>MANAGE FACULTY</h1>
    </div>
</section>

<div class="tabs" id="tab">
    <h3>MANAGE FACULTY</h3>
    <table class = "display-table">
    <thead>
        <th scope="col">Faculty ID</th>
        <th scope="col">Faculty Name</th>
        <th scope="col">Institute</th>
        <th scope="col">Location</th>
        <th scope="col">Delete</th>
    </thead>
        <tbody>
        <?php
            $records = mysqli_query($con, "SELECT * From faculty");
            while($data = mysqli_fetch_array($records)){
                $instid = $data['inst_id'];
                $sql = mysqli_query($con,"SELECT * FROM institute WHERE inst_id = $instid");
                $res = mysqli_fetch_array($sql);
                $cid = $data['inst_city'];
                $sql1 = mysqli_query($con,"SELECT * FROM city WHERE id = $cid");
                $res1 = mysqli_fetch_array($sql1);
                $sid = $res1['state_id'];
                $sql2 = mysqli_query($con,"SELECT * FROM state WHERE id = $sid");
                $res2 = mysqli_fetch_array($sql2);
                $loc = $res1['city_name'].",<br> ".$res2['name'];
                echo "<tr>";
                echo "<td>" .$data['fid']."</td>";
                echo "<td>" .$data['fname']."</td>";
                echo "<td>" .$res['inst_name']."</td>";
                echo "<td>" .$loc."</td>";
                echo "<td>
                        <form action='' method='POST'>
                            <input type='hidden' value=".$data['fid']." name='fid'>
                            <input type='submit' class='hero-btn2' name='deleteSt' value='Delete'>
                        </form>
                        </td>";
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