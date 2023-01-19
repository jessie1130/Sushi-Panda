<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
// // 資料庫查詢(送出查詢的SQL指令)
if (!empty($_GET['select'])) {
    $mode = $_GET['select'];
} else {
    $mode = "id";
}
if (!empty($_GET['select2'])) {
    $view = $_GET['select2'];
} else {
    $view = "8";
}
if ($priv < 3) {
    $product_address = "product-details.php";
} else {
    $product_address = "product-details_admin.php";
}
$id = "";
$data = "";
if ($result = mysqli_query($link, "SELECT * FROM product")) {
    $num = mysqli_num_rows($result); //查詢結果筆數
    for ($j = 0; $j < 6; $j++) {
        $row = mysqli_fetch_assoc($result);
         $id = $row["ID"];
        $data .= "<div class='single-products-catagory clearfix'>
                    <a href ='$product_address?id=$id'>
                        <img src='img/" . $row["picture"] . "' alt=''>
                        <div class='hover-content'>
                            <div class='line'></div>
                            <p>" . $row["price"] . "元</p>
                            <h4>" . $row["p_name"] . "</h4>
                        </div>
                    </a>
                </div>";
    }
    mysqli_free_result($result);
}

mysqli_close($link); // 關閉資料庫連結

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>

</head>

<body>

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/core-img/logo1.png" alt=""></a>
            </div>
            <!-- Navbar Toggler -->
            <div class="amado-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <!-- Header Area Start -->
        <header class="header-area clearfix">
            <!-- Close Icon -->
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <!-- Logo -->
            <div class="logo">
                <a href="index.php"><img src="img/core-img/logo1.png" alt=""></a>
            </div>
            <!-- Amado Nav -->
            <nav class="amado-nav">
                <ul>
                    <li class="active"><a href="index.php">首頁</a></li>
                    <li><a href="shop.php">商品</a></li>
                    <?php include("privilege_address.php"); ?>
                    <li><a href="<?php echo $checkout_address ?>">訂單查詢</a></li>
                    <li><a href="<?php echo $cart_address ?>">購物車</a></li>
                    <li><a href="<?php echo $user_address ?>">會員資料</a></li>
                </ul>
            </nav>
            <?php include("button.php"); ?>
        </header>
        <!-- Header Area End -->

        <!-- Product Catagories Area Start -->
        <div class="products-catagories-area clearfix">
            
            <div class="cart-table-area section-padding-100">
                <div class="container-fluid">
                    <div class="row">
                        <div class="cart-title mt-50 col-12">
                            <h2>關於我們</h2>
                        </div>
                        <div class="col-12 col-lg-4">
                            歡迎光臨 Sushi Panda！<br>
                            想吃壽司卻不想出門嗎？<br>
                            那就趕快下單你喜歡的壽司吧<br>
                            滿額就享免運費送到家<br>
                            Sushi Panda 隨叫隨吃<br>
                            <br>
                            我們也接受現場外帶喔<br>
                            建議先打電話預約<br>
                            連絡電話：04 7232105
                        </div>
                        <div class="col-12 col-lg-8 cart-table clearfix">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14569.518655305024!2d120.56247906534423!3d24.08814043944602!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x346938e9c332a5dd%3A0x7fd08ddba6e6a0cc!2z5ZyL56uL5b2w5YyW5bir56-E5aSn5a246YCy5b635qCh5Y2A!5e0!3m2!1szh-TW!2stw!4v1623673790350!5m2!1szh-TW!2stw" width="700" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="amado-pro-catagory clearfix">
                <?php echo $data ?>
            </div>
        </div>
        <!-- Product Catagories Area End -->
                        

                    
                    
             
            
        
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <?php include("footer.php"); ?>

</body>

</html>