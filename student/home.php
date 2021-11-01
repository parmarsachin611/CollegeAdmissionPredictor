<?php 

// INCLUDE DATABASE CONNECTION 
include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';
if (isset($_SESSION['sid'])) {
    $sid = $_SESSION['sid'];
}else {
    header("Location: ./login.php");
}
$sql1 = mysqli_query($con,"SELECT * FROM student WHERE sid = '$sid'");
$row1 = mysqli_fetch_assoc($sql1);
$name = $row1['fname']." ".$row1['lname'];
$f_flag = $row1['feedbackflag'];

if(isset($_POST['feedback1'])){
    $feed = mysqli_real_escape_string($con,$_POST['feedback']);
    $sql = mysqli_query($con,"UPDATE student SET feedback = '$feed', feedbackflag = '1' WHERE sid= '$sid'");
    if ($sql){
        echo "<script>alert('Feedback added to database sucessfully')</script>";
    }

    else{
        echo "<script>alert('Something went wrong.')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | College Admission Predictor</title>
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
        <h1>WELCOME, <?php echo $name; ?></h1>
    </div>
</section> 
<div class="tabs">
  
  <input type="radio" id="tab1" name="tab-control" checked>
  <input type="radio" id="tab2" name="tab-control">
  <input type="radio" id="tab3" name="tab-control">  
  <input type="radio" id="tab4" name="tab-control">
  <ul>
    <li title="Home"><label for="tab1" role="button"><svg viewBox="0 0 24 24"><path d="M14,2A8,8 0 0,0 6,10A8,8 0 0,0 14,18A8,8 0 0,0 22,10H20C20,13.32 17.32,16 14,16A6,6 0 0,1 8,10A6,6 0 0,1 14,4C14.43,4 14.86,4.05 15.27,4.14L16.88,2.54C15.96,2.18 15,2 14,2M20.59,3.58L14,10.17L11.62,7.79L10.21,9.21L14,13L22,5M4.93,5.82C3.08,7.34 2,9.61 2,12A8,8 0 0,0 10,20C10.64,20 11.27,19.92 11.88,19.77C10.12,19.38 8.5,18.5 7.17,17.29C5.22,16.25 4,14.21 4,12C4,11.7 4.03,11.41 4.07,11.11C4.03,10.74 4,10.37 4,10C4,8.56 4.32,7.13 4.93,5.82Z"/>
</svg><br><span>HOME</span></label></li>
    <li title="Predictor"><label for="tab2" role="button"><svg viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
  <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
</svg><br><span>PREDICTOR</span></label></li>
    <li title="Viewprofile"><label for="tab3" role="button"><svg viewBox="0 0 24 24">
  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
</svg><br><span>VIEW PROFILE</span></label></li>    <li title="Feedback"><label for="tab4" role="button"><svg viewBox="0 0 24 24">
    <path d="M11,9H13V7H11M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M11,17H13V11H11V17Z" />
</svg><br><span>FEEDBACK</span></label></li>
  </ul>
  
  <div class="slider"><div class="indicator"></div></div>
  <div class="content">
    <section>
        <h2>HOME</h2>
        <h3>Predict your Admissions chances <br> based on Real Data</h3>
        <p>
            CAP is the only free college guidance company that offers data-driven chancing, then works with students to help optimize their profiles. We use thousands of real acceptance results to fine-tune our algorithm. We also explain your chancing results and teach you how to strengthen your profile.
        </p>
    </section>
    <section>
        <h2>PREDICTOR</h2>
        <a href="./predictor.php" class="hero-btn1">PREDICT COLLEGE</a>
        <a href="./viewcollege.php" class="hero-btn1">VIEW ALL COLLEGE</a>
    </section>
    <section>
        <h2>VIEW PROFILE</h2>
        <a href="./viewprofile.php" class="hero-btn1">VIEW PROFILE</a>
        <a href="./editprofile.php" class="hero-btn1">EDIT PROFILE</a>
    </section>
    <section>
        <h2>FEEDBACK</h2>
        <?php 
            if ($f_flag == 0) {
                echo "
                <form action='' method='POST' style='display:flex;flex-direction:column;justify-content:center;' enctype='multipart/form-data'>
                <label for='feedback'>Feedback: </label>
                <br>
                    <textarea name='feedback' ></textarea>
                    <input type='submit' class='hero-btn1' name='feedback1'  value='Feedback Submit'>
                </form>
                
                ";
            }else{
                echo "<h4 style='margin-left:350px;'>Feedback Submitted</h4>";
            }
        ?>
    </section>
  </div>
</div>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>   
</body>
</html>