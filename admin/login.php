<?php
    
    include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'dbconn.php';

    if(isset($_POST['submit'])){
        $admin = mysqli_real_escape_string($con,trim($_POST['admin']));
        $Pass = mysqli_real_escape_string($con,trim($_POST['password']));
        // $aPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

        // $sql = mysqli_query($con,"INSERT INTO `admin`(`adminusername`, `adminpass`) VALUES ('$admin','$aPassword')");
        
        $sql = "SELECT * FROM admin WHERE adminusername = '$admin'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);
        $AdminPassword = $row['adminpass'];
        $aid = $row['aid'];
        
        if(password_verify($Pass,$AdminPassword)){
            $_SESSION['aid'] = $aid;
            header("Location: home.php");
        }
        else{
            echo "<script>alert('Invalid Credentials.')</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | College Admisssion Predictor</title>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'links.php';
    ?>
</head>
<body>
    <section class="header">
        <?php
            include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'header.php';
        ?>
        <!-- -----------------ADMIN LOGIN----------------------- -->
        <div class="container">
            <div class="card">
                <div class="inner-box" id="card">
                    <!-- LOGIN -->
                    <div class="card-front">
                        <h2>ADMIN-LOGIN</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="text" name="admin" class="input-box" placeholder="Username"  required>
                            <input type="password" name="password" class="input-box" placeholder="Password" required>
                            <button type="submit" name="submit" class="submit-btn">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'steps.php';
    ?>
    <?php
        include dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'footer.php';
    ?>
</body>
</html>