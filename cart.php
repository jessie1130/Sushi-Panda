<?php
$cart = "";
$p_id = "";
$p_amount = "";
$data = "";
$price = "";
$amount = "";
$product = "";
$date = "";

$money = 0;
$dc = 0;
$total = 0;

session_start();
$user = $_SESSION['user'];
include("connection.php");
include("privilege.php");

$result = mysqli_query($link, "SELECT * FROM product");

$change_id = "nul";

if (isset($_SESSION['cart'])) {

    $cnt = count($_SESSION['cart']);
    $data .= "<td class='cart_product_img'>";
    date_default_timezone_set('Asia/Taipei');
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $date = $year . "-" . $month . "-" . $day;
    $amount = "";
    $product = "";
    for ($j = 0; $j < $cnt; $j++) {
        $p_id = $_SESSION['cart'][$j][0];
        $p_amount = $_SESSION['cart'][$j][1];

        mysqli_data_seek($result, $p_id - 1);
        $row = mysqli_fetch_assoc($result);

        $price = $row["price"] * $p_amount;
        if ($product == "") {
            $product .= $row["p_name"];
            $amount .= $p_amount;
        } else {
            $product .= "," . $row["p_name"];
            $amount .= "," . $p_amount;
        }

        $money += $price;
        if ($money >= 99) {
            $dc = 0;
        } else
            $dc = 60;

        $total = $money + $dc;

        $kk = 8;

        $data .=
            "<tr>
        <td class='cart_product_img'>
                <a href='product-details.php?id=$p_id'><img src='img/" . $row["picture"] . "' alt='Product'></a>
            </td>
            <td class='cart_product_desc'>
                <h5>" . $row["p_name"] . "</h5>
            </td>
            <td class='price'>
                <span>$price</span>
            </td>
            <td class='qty'>
                <div class='cart-fav-search mb-100'>
                    <div class='qty-btn d-flex'>
                        <p>數量</p>
                        <div class='quantity'>   

                        <input type='number' class='qty-text' id='qty$p_id' step='1' min='1' max='300' name='quantity'value=$p_amount 
                        onchange=location.replace('put_in_cart.php?action=change&id=" . $p_id . "&qty='+document.getElementById('qty$p_id').value);
                        >

                        </div>
                    </div>
                    </br>
                    <div>
                        <a href='put_in_cart.php?action=delete&id=" . $p_id . "'>
                            <span class='text-danger'>從購物車移除</span>
                        </a>
                    </div>
                </div> 
            </td>
        </tr>";
    }
} else {
    $cnt = 0;
}
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
                    <li class="active"><a href="<?php echo $cart_address ?>">購物車</a></li>
                    <li><a href="<?php echo $user_address ?>">會員資料</a></li>

                </ul>
            </nav>
            <?php include("button.php"); ?>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <form class="cart clearfix" method="post" action="put_in_checkout.php">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="cart-title mt-50">
                                <h2>購物車</h2>
                            </div>

                            <div class="cart-table clearfix">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>商品名稱</th>
                                            <th>商品價錢</th>
                                            <th>數量</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $data ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="cart-summary">

                                <h5>總金額 (超過 $99 免運費)</h5>
                                <ul class="summary-table">
                                    <li><span>商品總價:</span> <span>$<?php echo $money ?></span></li>
                                    <li><span>運費:</span> <span>$<?php echo $dc ?></span></li>
                                    <li><span>總共:</span> <span>$<?php echo $total ?></span></li>
                                </ul>
                                <?php
                                if ($total == 0) {
                                    $dis = "disabled='disabled'";
                                    $s = "請將商品加入購物車";
                                } else {
                                    $dis = "";
                                    $s = "確認送出";
                                }
                                ?>      
                                <div class="cart-btn mt-100">
                                    <input name="total" value="<?php echo $total ?>" style="display: none;">
                                    <input name="account" value="<?php echo $user ?>" style="display: none;">
                                    <input name="date" value="<?php echo $date ?>" style="display: none;">
                                    <input name="product" value="<?php echo $product ?>" style="display: none;">
                                    <input name="amount" value="<?php echo $amount ?>" style="display: none;">
                                    <button type="summit" class="btn amado-btn w-100"<?php echo $dis?>><?php echo $s ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <?php include("footer.php"); ?>

</body>

</html>