<?php
    include ('views/header.php');
    include ('views/form_login.php');
    if (!isset($_SESSION['user'])) {
        echo '<p class ="text-danger text-center" style = "font-size:30px;margin: 350px 0;">Chức năng yêu cầu đăng nhập</p>';
    }else{
     	include ('views/lichsu.php');
    }

    include ('views/footer.php');
?>