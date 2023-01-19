<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
// // 資料庫查詢(送出查詢的SQL指令)
$sql = "SELECT * FROM product";
$pict_bot = "";
$pict_top = "";
$data = "";
$cart = "";
$add_cart = "";
$name = "";
$content = "";
$price = "";
$id = (isset($_GET['id'])) ? $_GET['id'] : 1;
if ($result = mysqli_query($link, $sql)) {
    mysqli_data_seek($result, ($_GET['id']) - 1);
    $row = mysqli_fetch_assoc($result);
    $name = $row["p_name"];
    $content = $row["content"];
    $price = $row["price"];
    //picture bottom 我現在先設定兩頁 看你想怎麼改
    for ($j = 0; $j < 2; $j++) {
        if ($j == 0) {
            $pict_bot .= "
        <li class='active' data-target='#product_details_slider' data-slide-to='" . $j . "' style='background-image: url(img/" . $row["picture"] . ");'>
        </li>";
        } else {
            $pict_bot .= "
        <li data-target='#product_details_slider' data-slide-to='" . $j . "' style='background-image: url(img/core-img/logo1.png);'>
        </li>";
        }
    }
    //picture top
    for ($j = 0; $j < 2; $j++) {
        if ($j == 0) {
            $pict_top .= "<div class='carousel-item active'>
                <a class='gallery_img' href='img/" . $row["picture"] . "'>
                    <img class='d-block w-100' src='img/" . $row["picture"] . "' alt='First slide'>
                </a>
            </div>";
        } else {
            $pict_top .= "<div class='carousel-item'>
                <a class='gallery_img' href='img/core-img/logo1.png'>
                    <img class='d-block w-100' src='img/core-img/logo1.png' alt='First slide'>
                </a>
            </div>";
        }
    }
}

mysqli_free_result($result); // 釋放佔用的記憶體

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
                    <li><a href="index.php">首頁</a></li>
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

        <!-- Product Details Area Start -->
        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="index.php">首頁</a></li>
                                <li class="breadcrumb-item"><a href="shop.php">商品</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $name ?></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php echo $pict_bot ?>
                                </ol>

                                <div class="carousel-inner">
                                    <?php echo $pict_top ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <!-- Product Meta Data -->
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price"><?php echo $price ?>元</p>

                                <h6><?php echo $name ?></h6>
                                <!-- Ratings & Review -->
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                    </div>
                                    <div class="review">
                                        <a href="delete_product.php?id=<?php echo $_GET['id'] ?>">移除此商品</a>
                                    </div>
                                </div>
                                <!-- Avaiable -->
                                <p class="avaibility"><i class="fa fa-circle"></i>有現貨</p>
                            </div>

                            <div class="short_overview my-5">
                                <p><?php echo $content; ?></p>
                            </div>

                            <!-- Add to Cart Form -->
                            <form class="cart clearfix" method="get" action="put_in_cart.php">
                                <div class="cart-btn d-flex mb-50">
                                    <p>數量</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                        <input name="id" value="<?php echo $id ?>" style="display: none;">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <?php
                                if ($priv == 1) {
                                    $dis = "disabled='disabled'";
                                    $s = "請先登入才能加入購物車";
                                    $s1 = "請先登入才能加入我的最愛";
                                    $adis = "#" ;
                                } else {
                                    $dis = "";
                                    $s = "加入購物車";
                                    $s1 = "加入我的最愛";
                                    $adis = "put_in_wish.php?id=$id";
                                }
                                ?>
                                <a  href="<?php echo $adis ?>" name="addtowish" value="1" class="btn btn-outline-warning" <?php echo $dis ?>> <?php echo $s1 ?></a>
                                </br></br>
                                <button type="summit" name="addtocart" value="1" class="btn amado-btn" <?php echo $dis ?>><?php echo $s ?></button>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Details Area End -->
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <?php include("footer.php"); ?>

</body>

</html>