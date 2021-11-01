<nav>
    <a href="../index.php"><h3 class="logo-text">College Admission Prediction</h3></a>
    <div class="nav-links" id="navLinks">
        <i class="fa fa-times" onclick="hideMenu()"></i>
        <ul>
            <?php if(isset($_SESSION['aid'])){?>
                <li><a href="./about">ABOUT</a></li>
                <li><a href="../includes/logout.php">LOGOUT</a></li>
             <?php }elseif(isset($_SESSION['sid'])){?>   
                <li><a href="./about">ABOUT</a></li>
                <li><a href="../includes/logout.php">LOGOUT</a></li>
             <?php }else{?>   
            <li><a href="../index.php">HOME</a></li>
            <li><a href="./login.php">LOGIN</li>
            <li><a href="./about.php">ABOUT</a></li>
            <li><a href="./contact.php">CONTACT</a></li>
            <?php }?>
        </ul>
    </div>
    <i class="fa fa-bars" onclick="showMenu()"></i>
</nav>
<!-- --------JavaScript for toogle button-------- -->
<script>

    var navLinks = document.getElementById("navLinks");

    function showMenu(){
        navLinks.style.right = "0";
    }
    function hideMenu(){
        navLinks.style.right = "-200px";
    }

</script>
