<?php

include 'config.php';

// Kiem tra gia tri --> boolean
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $password = mysqli_real_escape_string($con, $_POST['password']); 
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);

    // Truy vấn database
    $use = mysqli_query($con, "USE `manage_account`");

    $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE email = '$email' AND phone = '$phone'") or die('query failed');

    
    // $number = preg_match('@[0-9]@', $password);
    // $uppercase = preg_match('@[A-Z]@', $password);
    // $lowercase = preg_match('@[a-z]@', $password);
    // !$number || !$uppercase || !$lowercase || !$specialChars || 
    $specialChars = preg_match('@[^\w]@', $password);
        
    if (mysqli_num_rows($select) > 0){ 
        $message[] = "Email và số điện thoại đã tồn tại";
    } else {
        if ($password != $confirm_password) {
        $message[] = "Mật khẩu nhập lại không chính xác";
        } else if(strlen($password) < 8 || strlen($password) > 16) {
            $message[] = "Sai định dạng mật khẩu";
        } else if(strlen($phone) < 10 || strlen($phone) > 10) {
            $message[] = "Sai định dạng số điện thoại";
        } else if(!$specialChars) {
            $message[] = "Sai định dạng mật khẩu";
        } else {
            $crypt_password = mysqli_real_escape_string($con, md5($_POST['password'])); 
            $insert = mysqli_query($con, "INSERT INTO `user_information`(name, email, phone, password) VALUES ('$name', '$email', '$phone', '$crypt_password')") or die('query failed');
            header('location:login.php');
        }
}

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="CSS/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <script src="JS/jquery-3.5.1.min.js"></script>
    <script src="JS/multislider.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Đăng ký</title>
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
        <form action="" method="post" enctype="multipart/form-data" class="form" id="form-1">
            <h1>Đăng ký</h1>
            <?php
                if (isset($message)) {
                    foreach ($message as $message) {
                        echo '<div class="message">
                            '.$message.'
                        </div>';
                    }
                }
            ?>
            <input type="text" placeholder="Tên" name="name" required class="box">
            <input type="email" placeholder="Email" name="email" required class="box" id="email">
            <input type="number" placeholder="Số điện thoại" name="phone" required class="box" id="password">
            <input type="password" placeholder="Mật khẩu (Tối thiểu 8 kí tự và ít nhất 1 kí tự đặc biệt)" name="password" required class="box">
            <input type="password" placeholder= "Nhập lại mật khẩu" name="confirm_password" required class="box">
            <!-- <input type="file" name="image" class="box" accept="image/jpg, image/png"> -->
            <input type="submit" value="Đăng ký" name="submit" class="btn">
            <p>Bạn đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
        </form>
    </div>
    
</body>
</html>