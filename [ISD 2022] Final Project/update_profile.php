<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (isset($_POST['update_profile'])) {
    $use = mysqli_query($con, "USE `manage_account`");
    $update_name = mysqli_real_escape_string($con, $_POST['update_name']);
    $update_email = mysqli_real_escape_string($con, $_POST['update_email']);
    $update_phone = mysqli_real_escape_string($con, $_POST['update_phone']);
    
    $old_password = $_POST["old_password"];
    $current_password = mysqli_real_escape_string($con, md5($_POST["current_password"])); 
    $new_password = mysqli_real_escape_string($con, $_POST["new_password"]); 
    $confirm_password = mysqli_real_escape_string($con, $_POST["confirm_password"]); 

    $specialChars = preg_match('@[^\w]@', $new_password);

    if (!empty($current_password) || !empty($new_password)|| !empty($confirm_password)) {
        if($current_password != $old_password) {
            $message[] = "Mật khẩu hiện tại không chính xác";
        } else if(strlen($new_password) < 8 || strlen($new_password) > 16) {
            $message[] = "Sai định dạng mật khẩu";         
        } else if (!$specialChars) {
            $message[] = "Sai định dạng mật khẩu";         
        }else {
            $use = mysqli_query($con, "USE `manage_account`");
            $new_crypt = mysqli_real_escape_string($con, md5($_POST['new_password'])); 
            mysqli_query($con, "UPDATE `user_information` SET name = '$update_name', email = '$update_email', phone = '$update_phone', password = '$new_crypt' WHERE id = '$user_id'") or die('query failed');
            $success_message[] = "Cập nhật thành công";
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
    <title>Cập nhật thông tin cá nhân</title>
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
                    <a href="">
                        <!-- <button class="account-btn">
                            <i class="fas fa-user-alt"></i>
                        </button> -->

                        <li class="header__navbar-item header__navbar-user">

                            <span class="account-text">
                                <?php 
                                include 'config.php';
                                $user_id = $_SESSION['user_id'];
                                $use = mysqli_query($con, "USE `manage_account`");
                                $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
                                if (mysqli_num_rows($select) > 0) {
                                $fetch = mysqli_fetch_assoc($select);
                                }
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                        echo "Hi, " .$fetch['name'];
                                    } else {
                                        echo "Đăng nhập";
                                    }
                                ?>
                            </span>
                            <ul class="header__navbar-user-menu">
                                <li class="header__navbar-user-item">
                                    <a href="update_profile.php" class="">Cập nhật thông tin</a>
                                </li>
                                <li class="header__navbar-user-item">
                                    <?php 
                                        include 'config.php';
                                        $user_id = $_SESSION['user_id'];
                                        
                                        if (isset($_GET['logout'])) {
                                            unset($user_id);
                                            session_destroy();
                                            header('location: login.php');
                                        }
                                    ?>
                                    <a href="index.php?logout=<?php echo $user_id; ?>" class="">Đăng xuất</a>
                                    
                                </li>
                            </ul>
                        </li>
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


    <div class="update-profile">
        <?php
            $use = mysqli_query($con, "USE `manage_account`");
            $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);                
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <h1>Cập nhật thông tin cá nhân</h1>
            <?php
            if(isset($message)){
                foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
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
           
            <div class="flex">
                <div class="input-box">
                    <span>Tên người dùng</span>
                    <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class = "box" require>
                    <span>Email</span>
                    <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class = "box" require>
                    <span>Số điện thoại</span>
                    <input type="phone" name="update_phone" value="<?php echo $fetch['phone']; ?>" class = "box" require>
                    
                </div>
                <div class="input-box">
                    <input type="hidden" name="old_password" value="<?php echo $fetch['password']; ?>">
                    <span>Mật khẩu hiện tại</span>
                    <input type="password" name="current_password" class="box" require>
                    <span>Mật khẩu mới</span>
                    <input type="password" placeholder="8-16 kí tự và ít nhất 1 kí tự đặc biệt" name="new_password" class="box" require>
                    <span>Nhập lại mật khẩu mới</span>
                    <input type="password" name="confirm_password" class="box" require> 
            </div>
            </div>
            
            <input type="submit" value="Cập nhật" name="update_profile" class="btn">
            <a href="home.php" class="btn-delete">Quay lại</a>
        </form>
    </div>
</body>
</html>