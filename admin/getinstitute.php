<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbConn.php';
error_reporting(0);


$uid = $_REQUEST['u_id'];
$sqlbl = "SELECT * FROM institute WHERE u_id = '".$uid."'";
$resultbl = mysqli_query($con,$sqlbl);

if (mysqli_num_rows($resultbl) > 0)
{    
    while ($rowbl = mysqli_fetch_assoc($resultbl))
{
    echo "<option value='".$rowbl['inst_id']."'>".$rowbl['inst_name']."</option>";
}
}

?>