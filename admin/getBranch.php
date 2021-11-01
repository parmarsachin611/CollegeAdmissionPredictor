<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';


$stid = $_REQUEST['st_id'];
$sqlbl = "SELECT * FROM branch WHERE st_id = '".$stid."'";
$resultbl = mysqli_query($con,$sqlbl);

if (mysqli_num_rows($resultbl) > 0)
{    
    while ($rowbl = mysqli_fetch_assoc($resultbl))
{
    echo "<option value='".$rowbl['b_id']."'>".$rowbl['b_name']."</option>";
}
}

?>