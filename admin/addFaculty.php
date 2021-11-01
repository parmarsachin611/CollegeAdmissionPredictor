<?php

include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['aid'])) {
    $aid = $_SESSION['aid'];
}else {
    header("Location: ./login.php");
}

if (isset($_POST['addfaculty'])) {
    $fname = mysqli_real_escape_string($con,$_POST['faculty']);
    $instid = mysqli_real_escape_string($con,$_POST['instid']);
    $desc = mysqli_real_escape_string($con,$_POST['desc']);
    $city = mysqli_real_escape_string($con,$_POST['city']);
    $email = mysqli_real_escape_string($con,trim($_POST['colemail']));
    $phone = mysqli_real_escape_string($con,trim($_POST['colphone']));

    $sql = mysqli_query($con,"SELECT * FROM faculty WHERE inst_id = '$instid'");
    if(!$sql -> num_rows>0){

    // Validation
    $secure = 99;
    if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",$email)){
        $secure = 1;
        echo "<script>alert('Invalid Email')</script>";
    }
    if(!preg_match("/^[a-zA-Z ]*$/",$fname) AND !preg_match("/^([a-zA-Z' ]+)*$/",$desc)){
        $secure = 2;
        echo "<script>alert('Invalid Name & Description')</script>";
    }
    if(!preg_match('/^[0-9]{10}$/', $phone)){
        $secure = 3;
        echo "<script>alert('Invalid Phone Number')</script>";
    }
    if ($secure == 99) {
            $filename = $_FILES["colimg"]["name"];
            $tempname = $_FILES["colimg"]["tmp_name"];
            $file_split = explode(".", $filename);
            $file_ext = strtolower(end($file_split));
            $t = time();
            $f_name = $t."_".$filename;
            $extentions = ['png','jpg','jpeg'];
            if(in_array($file_ext, $extentions) == true){
                $dir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'CollegeImages'.DIRECTORY_SEPARATOR.$f_name;
                $query = mysqli_query($con,"INSERT INTO `faculty`( `inst_id`, `fname`, `inst_desc`, `inst_img`, `inst_phone`, `inst_email`, `inst_city`) VALUES ('$instid','$fname','$desc','$f_name','$phone','$email','$city')");
                move_uploaded_file($tempname, $dir);
                $query1 = mysqli_query($con,"UPDATE institute SET faculty_flag = '1' WHERE inst_id = '$instid'");
                if ($query) {
                    echo "<script>alert('Faculty added to database sucessfully')</script>";
                }else{
                    echo "<script>alert('Something went wrong.')</script>";
                }
            }else{
                echo "<script>alert('PNG JPG JPEG Format Only')</script>";
            }
    }
} else{
    echo "<script>alert('Faculty Already Assigned to this institute.')</script>";
}  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Faculty | College Admission Predictor</title>
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
        <h1>ADD FACULTY</h1>
    </div>
</section>

<div class="tabs" id="tab">
    <h3>ADD FACULTY</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="faculty">Add Faculty Name:</label>
            <input type="text" name="faculty" placeholder="Enter Faculty Name..." required>
        </div>
        <div class="col">
        <label for='instid'>Select Institute:</label>
        <select name='instid'required>
            <option value='' disabled selected >Select Institute Name</option>
                <?php 
                    $records = mysqli_query($con, "SELECT * From institute WHERE faculty_flag = '0'");

                    while($data = mysqli_fetch_array($records))
                    {
                        echo "<option value='". $data['inst_id'] ."'>" .$data['inst_name'] ."</option>";
                    }	
                ?>  
        </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="desc">Add College Description:</label><br>
            <Textarea name="desc" placeholder="Enter College Description..." cols="47" row="4" required></Textarea>
        </div>
        <div class="col">
            <label for="colimg">Add College Image:</label><br>
            <input type="file" accept="image/*" name="colimg" onchange=readURL(this) required><br>
            <h6 style="font-weight: bold">(PNG JPG JPEG Format Only)</h6>
            <img style="display:none;margin: 10px;border: 1px solid black;" id="preview" src="#" alt="your image"  />
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for='state'>Select State:</label>
            <select id="stategroup" onchange="checkcity()" name='state'required>
                <option value='' disabled selected >Select State Name</option>
                    <?php 
                        $records = mysqli_query($con, "SELECT * From state");

                        while($data = mysqli_fetch_array($records))
                        {
                            echo "<option value='". $data['id'] ."'>" .$data['name'] ."</option>";
                        }	
                    ?>  
            </select>
        </div>
        <div class="col" style="margin-left: 105px;">
        <label for='city'>Select City:</label>
            <select id='citygroup' name='city'required>
                <option value='' disabled selected >Select City Name</option>  
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="colemail">Add Faculty Email:</label>
            <input type="email" name="colemail" placeholder="Enter Faculty Email..." required>
        </div>
        <div class="col">
            <label for="colphone">Add Faculty Phone No:</label>
            <input type="number" name="colphone" placeholder="Enter Faculty Phone No..." required>
        </div>
    </div>
    <input type="submit" class="hero-btn1" name="addfaculty"  value="Add Faculty">

    
</form>
<br>
<a style="margin-left: 350px;" href="./home.php" class="hero-btn2">BACK</a>
</div>



<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
?>
<?php
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
?>
<script>
        // Image Preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                    $('#preview')
                        .attr('src', e.target.result)
                        .width(100)
                        .css("display", "block")
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        // To Enable the City Dropdown
        function checkcity() {
            var s_id = document.getElementById("stategroup").value;
            $.ajax({
                url : "getCity.php?s_id="+s_id,
                success:function(response){
                    console.log(response);
                    $("#citygroup").html(response);
                }
            })
        }
</script>
</body>
</html>