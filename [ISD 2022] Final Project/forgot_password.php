<?php

include 'config.php';
session_start();

if (isset($_POST["submit_email"])) {
    $use = mysqli_query($con, "USE `manage_account`");

    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $check_email = mysqli_query($con, "SELECT * FROM `user_information` WHERE email='$email'") or die('query failed');


    if (mysqli_num_rows($check_email) > 0) {
        $data = mysqli_fetch_assoc($check_email);
        $password = rand(999, 99999);
        $password_hash = md5($password);
        $update_password = mysqli_query($con, "UPDATE `user_information` SET password='$password_hash' WHERE email='$email'") or die('query failed');
        
        $to = $email;
        $subject = "Đặt lại mật khẩu";

        $message_mail = "
        <html>
        <head>
        <title>{$subject}</title>
        </head>
        <body>
        <p>Mật khẩu mới của bạn là: {$password}</p>
        <p>Bạn vui lòng đăng nhập lại theo link dưới đây và đổi lại mật khẩu ngay sau khi đăng nhập</p>
        <p><a href='{$link_reset}'>Đăng nhập</a></p>

        </body>
        </html>
        ";


        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    

        $headers .= "From: ". $my_email;

        if (mail($to,$subject,$message_mail,$headers)) {
            $success_message[] = "Chúng tôi đã gửi mật khẩu mới đến email của bạn  {$email}.";
        } else {
            $message[] = "Mail chưa được gửi, vui lòng kiểm tra lại";
        }
    }
    else {
        $message[] = "Email của bạn chưa được đăng ký";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="CSS/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <script src="JS/jquery-3.5.1.min.js"></script>
    <script src="JS/multislider.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<style>
        #logo { 
        float:left;
        width:140px;
        height: 110px;
        padding: 15px;
        }
</style>
    <!--Navbar-->
    <nav>
        <!--Navbar has two part the top one and the bottom one-->
        <!--Here is top one and in this part I put logo, my account part, and the shopping cart-->
        <div class="navbar-top">
            <div>
                <button id="menuButton"><i class="fas fa-bars"></i></button>
                <!--Logo-->
                
                <a href="index.php" id ="logo">
                    <img src="Images/Other/apple.png" alt="">

                </a>
            
            
            </div>
            <div>
                <!--My account part-->
                <div class="account">
                    <a href="index.html">
                        <!-- <button class="account-btn">
                            <i class="fas fa-user-alt"></i>
                        </button> -->
                        <span class="account-text"><a href="./login.php" class="account-text-log">Đăng nhập</a></span>
                    </a>
                    <!--When we click the btnShowAccountInfo this section will be displayed-->
                </div>
                <!--Shopping cart-->
                <div class="shopping-cart">
                    <div class="sum-prices">
                        <!--Shopping cart logo-->
                        <i class="fas fa-shopping-cart shoppingCartButton"></i>
                        <!--The total prices of products in the shopping cart -->
                        <h6 id="sum-prices"></h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- Navbar bottom part -->
        <!-- Here I put the links to the other pages or nav links -->
        <div class="navbar" id="navbar">
            <ul class="links">
                
                
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Samsung</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Xiaomi</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Oppo</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Nokia</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobil.html" class="link"><strong>Iphone</strong></a>
                </li>
                <li class="nav-links">
                    <a href="mobile.html" class="link"><strong>Vivo</strong></a>
                </li>
                <li class="nav-links">
                    <a herf="mobile.html" class="link"><strong>ASUS</strong></a>
                </li>
                <li class="nav-links">
                    <a herf="mobile.html" class="link"><strong>Realme</strong></a>
                </li>
                
                
            </ul>
        

            <!-- The searchbar which will be in the right side of the links -->
            <div class="searchbar">
                <form action="#">
                    <input type="search" placeholder="Bạn muốn tìm kiếm sản phẩm nào" />
                    <i class="fa fa-search" id="search-icon"></i>
                </form>
            </div>
        </div>
        <div class="producstOnCart hide">
            <div class="overlay"></div>
            <div class="top">
                <button id="closeButton">
                    <i class="fas fa-times-circle"></i>
                </button>
                <h3>Giỏ hàng</h3>
            </div>
            <ul id="buyItems">
                <h4 class="empty">Giỏ hàng của bạn đang trống</h4>
            </ul>
            <button class="btn checkout hidden">Kiểm tra giỏ hàng ngay</button>
        </div>
    </nav>
    <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data" class="form-container-forgot">
                <h1>Cấp lại mật khẩu</h1>
                <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<div class="message">
                                '.$message.'
                            </div>';
                        }
                    }
                ?>
                <?php
                if(isset($success_message)){
                    foreach($success_message as $success_message){
                    echo '<div class="success_message">'.$success_message.'</div>';
                    }
                }
                ?>
                <p>Vui lòng nhập email bạn đã đăng ký</p>
                <input type="email" placeholder="Email" name="email" required class="box">
                <input type="submit" value="Cấp lại mật khẩu" name="submit_email" class="btn">
            </form>
    </div>
</body>
</html>