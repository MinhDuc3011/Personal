

<!DOCTYPE html>
<html lang="sv">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link type="text/css" href="CSS/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
    <script src="JS/jquery-3.5.1.min.js"></script>
    <script src="JS/multislider.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>WEB ĐIỆN THOẠI</title>
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
                    <a href="">
                        <!-- <button class="account-btn">
                            <i class="fas fa-user-alt"></i>
                        </button> -->
                        
                        <li class="header__navbar-item header__navbar-user">

                            <span class="account-text">
                                <?php 
                                    include 'config.php';
                                    session_start();

                                    
                                    
                                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                        $user_id = $_SESSION['user_id'];
                                        $use = mysqli_query($con, "USE `manage_account`");
                                        $select = mysqli_query($con, "SELECT * FROM `user_information` WHERE id = '$user_id'") or die('query failed');
                                        if (mysqli_num_rows($select) > 0) {
                                            $fetch = mysqli_fetch_assoc($select);
                                        }
                                        echo "Hi, " .$fetch['name'];
                                    } else {
                                        echo "<a href='login.php' class='account-text-login' style=''>Đăng nhập</a>";
                                        echo " <style>
                                                .header__navbar-user:hover .header__navbar-user-menu {display: none; }
                                            </style>";                                                                                                       
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
    <header id="hearderSlide">
        <div class="MS-content">
            <a href="detail_page.html" class="item">
                <img src="Images/Other/slide1.jpg" />
            </a>
            <a href="detail_page.html" class="item">
                <img src="Images/Other/slide2.jpg" />
            </a>
            <a href="detail_page.html" class="item">
                <img src="Images/Other/slide3.jpg" />
            </a>
            <a href="detail_page.html" class="item">
                <img src="Images/Other/slide4.jpg" />
            </a>
            <a href="detail_page.html" class="item">
                <img src="Images/Other/slide5.jpg" />
            </a>
        </div>
        <div class="MS-controls">
            <button class="MS-right">
                <i class="fas fa-chevron-right fa-3x"></i>
            </button>
            <button class="MS-left">
                <i class="fas fa-chevron-left fa-3x"></i>
            </button>
        </div>
    </header>
    <main>
        <section class="main-section">
            <div class="product-container">
                <h3>SẢN PHẨM NỔI BẬT</h3>
                <div class="products">
                    <div class="product">
                        <div class="product-under">
                            <figure class="product-image">
                                <img src="Images/producs-images/Phones/ip13.png" alt="popular labtops and computers" />
                                <div class="product-over">
                                    <button class="btn btn-small addToCart" data-product-id="1">
                                        <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                    </button>
                                    <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                </div>
                            </figure>
                            <div class="product-summary">
                                <h4 class="productName">Iphone 13</h4>
                                <span class="stars"></span>

                                <h6 class="price">
                                    <span class="priceValue">21.590.000đ</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="product">
                        <div class="product-under">
                            <figure class="product-image">
                                <img src="Images/producs-images/Phones/iphone-12-pro-max.png"
                                    alt="popular labtops and computers" />
                                <div class="product-over">
                                    <button class="btn btn-small addToCart" data-product-id="2">
                                        <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                    </button>
                                    <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                </div>
                            </figure>
                            <div class="product-summary">
                                <h4 class="productName">Iphone 12 Pro Max</h4>
                                <span class="stars"></span>
                                <h6 class="price">
                                    <span class="priceValue">28.490.000</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="product">
                        <div class="product-under">
                            <figure class="product-image">
                                <img src="Images/producs-images/Phones/ip13promax.png"
                                    alt="popular labtops and computers" />
                                <div class="product-over">
                                    <button class="btn btn-small addToCart" data-product-id="3">
                                        <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                    </button>
                                    <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                </div>
                            </figure>
                            <div class="product-summary">
                                <h4 class="productName">Iphone 13 Pro max</h4>
                                <span class="stars"></span>

                                <h6 class="price">
                                    <span class="priceValue">33.000.000đ</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="product">
                        <div class="product-under">
                            <figure class="product-image">
                                <img src="Images/producs-images/Phones/Samsung Galaxy Z.png"
                                    alt="popular labtops and computers" />
                                <div class="product-over">
                                    <button class="btn btn-small addToCart" data-product-id="4">
                                        <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                    </button>
                                    <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                </div>
                            </figure>
                            <div class="product-summary">
                                <h4 class="productName">Samsung Galaxy Z Flip</h4>
                                <span class="stars"></span>

                                <h6 class="price">
                                    <span class="priceValue">27.000.000đ</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="main-section">
            <div class="pop-mobiles">
                <div class="pop-mobiles-1">
                    <figure>
                        <img src="Images/producs-images/Mobiles/new_phone2.png" />
                    </figure>
                    <div>
                        <h2>REALME 9 PRO</h2>
                        <h3>Đặt hàng ngay 03.03 - 10.04</h3>
                        <p>
                            <ol>
                                <li>Chìm đắm trong từng khung hình - Màn hình Super AMOLED 6.6", 1080 x 2412 pixel</li>
                                <li>Hiệu năng mạnh mẽ, bộ nhớ cực khủng - Chipset Qualcomm Snapdragon 695, RAM 8GB </li>
                                <li>Năng lượng trọn vẹn cả ngày dài - Pin khủng với dung lượng 5000mAh</li>
                                <li>Ghi trọn mọi khoảnh khắc - Camera chính 64MP, quay video chất lượng 4K</li>
                                
                            </ol>
                        </p>
                        <h4>7.990.000đ</h4>
                        <a href="detail_page.html" class="btn">Mua ngay<i class="fas fa-angle-right"></i></a>
                    </div>
                </div>
                <h3>SẢN PHẨM CHUNG</h3>
                <div class="pop-mobiles-2">
                    <ul class="products">
                        <li class="product">
                            <div class="product-under">
                                <figure class="product-image">
                                    <img src="Images/producs-images/Mobiles/galaxynote10.png" alt="popular mobiles" />
                                    <div class="product-over">
                                        <button class="btn btn-small addToCart" data-product-id="5">
                                            <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                        </button>
                                        <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-summary">
                                    <h4 class="productName">Galaxy Note 10</h4>
                                    <span class="stars"></span>
                                    <h4 class="price">
                                        <span class="priceValue">8.000.000đ</span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="product">
                            <div class="product-under">
                                <figure class="product-image">
                                    <img src="Images/producs-images/Mobiles/OPPO Reno6 Z 5G.png"
                                        alt="popular mobiles" />
                                    <div class="product-over">
                                        <button class="btn btn-small addToCart" data-product-id="6">
                                            <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                        </button>
                                        <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-summary">
                                    <h4 class="productName">OPPO Reno6 Z 5G</h4>
                                    <span class="stars"></span>
                                    <h4 class="price">
                                        <span class="priceValue">8.790.000đ</span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="product">
                            <div class="product-under">
                                <figure class="product-image">
                                    <img src="Images/producs-images/Mobiles/Xiaomi Redmi Note 11.png"
                                        alt="popular mobiles" />
                                    <div class="product-over">
                                        <button class="btn btn-small addToCart" data-product-id="7">
                                            <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                        </button>
                                        <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-summary">
                                    <h4 class="productName">Xiaomi Redmi Note 11</h4>
                                    <span class="stars"></span>
                                    <h4 class="price">
                                        <span class="priceValue">4.490.000đ</span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="product">
                            <div class="product-under">
                                <figure class="product-image">
                                    <img src="Images/producs-images/Mobiles/Realme 9i.png" alt="popular mobiles" />
                                    <div class="product-over">
                                        <button class="btn btn-small addToCart" data-product-id="8">
                                            <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                        </button>
                                        <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-summary">
                                    <h4 class="productName">Realme 9i</h4>
                                    <span class="stars"></span>
                                    <h4 class="price">
                                        <span class="priceValue">5.690.000đ</span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="product">
                            <div class="product-under">
                                <figure class="product-image">
                                    <img src="Images/producs-images/Mobiles/Samsung Galaxy Note 20 Ultra 5G.png"
                                        alt="popular mobiles" />
                                    <div class="product-over">
                                        <button class="btn btn-small addToCart" data-product-id="9">
                                            <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                        </button>
                                        <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-summary">
                                    <h4 class="productName">Samsung Galaxy Note 20 Ultra 5G</h4>
                                    <span class="stars"></span>
                                    <h4 class="price">
                                        <span class="priceValue">20.000.000đ</span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                        <li class="product">
                            <div class="product-under">
                                <figure class="product-image">
                                    <img src="Images/producs-images/Mobiles/Nokia G10.png" alt="popular mobiles" />
                                    <div class="product-over">
                                        <button class="btn btn-small addToCart" data-product-id="10">
                                            <i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng
                                        </button>
                                        <a href="detail_page.html" class="btn btn-small">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-summary">
                                    <h4 class="productName">Nokia G10</h4>
                                    <span class="stars"></span>
                                    <h4 class="price">
                                        <span class="priceValue">4.990.000đ</span>
                                    </h4>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="footer-second">
            <div class="footer-column-1">
                <h3><address><i class="fas fa-user"></i>Thông tin liên hệ</address></h3>
                <ol>
                    <i class="footer-column-1">
                        <address>
                    </i>
                    <li>CÔNG TY CỔ PHẦN TMDVSX KỸ THUẬT LTN VIỆT NAM</li>
                    <li><i class="fas fa-search-location"></i> Số 145-147 Phố Trương Định, Quận Hai Bà Trưng, Hà Nội
                    </li>
                    <li><i class="fas fa-phone"></i> 0912.66.00.55</li>
                    <li><i class="fas fa-phone"></i> 091.337.4937</li>

                </ol>
            </div>
            <div class="footer-column-2">
                <address>
                    <h3><i class="fas fa-headset"></i> Dịch vụ khách hàng </h3>
                    <ol>
                        <li><a href="#">Mua hàng và thanh toán Online</a></li>
                        <li><a href="#">Mua hàng trả góp Online</a></li>
                        <li><a href="#">Tra thông tin đơn hàng</a></li>
                        <li><a href="#">Tra thông tin bảo hành</a></li>
                        <li><a href="#">Dịch vụ bảo hành điện thoại</a></li>
                    </ol>
            </div>
            <div class="footer-column-3">
                <address>
                    <h3> <i class="fas fa-info-circle"></i> Thông tin </h3>
                    <ol>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Trợ giúp</a></li>
                    </ol>
            </div>
        </div>
        <ul class="footer-last">
            <li>
                <p><i class="fab fa-cc-mastercard"></i></p>
            </li>
            <li>
                <p><i class="fab fa-cc-paypal"></i></p>
            </li>
            <li>
                <p><i class="fab fa-cc-visa"></i></p>
            </li>
            <li>
                <p><i class="fab fa-cc-amex"></i></p>
            </li>
        </ul>
    </footer>
    <script src="JS/script.js"></script>
    <script src="shopping-cart.js"></script>
</body>

</html>