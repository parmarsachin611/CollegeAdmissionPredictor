<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbConn.php';
error_reporting(0);


$sid = $_REQUEST['s_id'];
$sqlbl = "SELECT * FROM city WHERE state_id = '".$sid."'";
$resultbl = mysqli_query($con,$sqlbl);

if (mysqli_num_rows($resultbl) > 0)
{    
    while ($rowbl = mysqli_fetch_assoc($resultbl))
{
    echo "<option value='".$rowbl['id']."'>".$rowbl['city_name']."</option>";
}
}

?>