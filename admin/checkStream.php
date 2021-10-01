<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config.php';


$cid = $_REQUEST['c_id'];
$sql = "SELECT * FROM addstream WHERE c_id = '".$cid."'";
$result = mysqli_query($con,$sql);

if (mysqli_num_rows($result) > 0)
{    
    while ($row = mysqli_fetch_assoc($result))
{
    echo "<option value='".$row['stream_id']."'>".$row['c_stream']."</option>";
}
}

?>