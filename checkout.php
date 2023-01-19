<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
// 資料庫查詢(送出查詢的SQL指令)
$data = "";
$id = "";
$product = "";

if ($result = mysqli_query($link, "SELECT * FROM checkout where account ='$user' order by date")) {
    $num = mysqli_num_rows($result); //查詢結果筆數
    $pages = ceil($num / 1);
    if (!empty($_GET['page']))
        mysqli_data_seek($result, ($_GET['page'] - 1) * 1);
    for ($i = 0; $i < 1; $i++) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row)) {
            $id = $row['checkout_id'];
            $date = $row['date'];
            $total = $row['total'];
            $data .= "<table class='table table-responsive'>
                <thead>
                    <form action='delete_checkout.php' method='GET'>
                    <input name='id' value='" . $row['checkout_id'] . "' style='display: none;'>
                    <tr>
                        <th></th>
                        <th>訂單日期</th>
                        <th>商品總金額</th>
                        <th><button class='btn-outline-warning rounded-pill btn-sm border-0' onClick='submit()'>取消此訂單</button></th>
                    </tr>
                    </form>  
                </thead>
                <tbody> 
                    <tr>
                        <td></td>
                        <td>" . $date . "</td>
                        <td>" . $total . "</td>
                    </tr>
                    <div class='cart-table clearfix'>
                        <table class='table table-responsive'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>商品名稱</th>
                                    <th>商品數量</th>
                                </tr>
                            </thead>
                        <tbody>";
            $product = explode(",", $row['product_name']);
            $amount = explode(",", $row['product_amount']);
            for ($j = 0; $j < count($product); $j++) {
                $result2 = mysqli_query($link, "SELECT * FROM product where p_name ='$product[$j]'");
                $row2 = mysqli_fetch_assoc($result2);
                $image = $row2['picture'];
                $data .= "<tr>
                        <td><img src='img/" . $image . "'></td>
                        <td>" . $product[$j] . "</td>
                        <td>" . $amount[$j] . "</td>
                    </tr>";
            }
        }
        $data .= "</tbody></table></div></tbody></table>";
    }
    mysqli_free_result($result);
}
mysqli_close($link); // 關閉資料庫連結
$page = "";
if (empty($_GET['page'])) {
    if ($pages == 0)
        $_GET['page'] = 0;
    else
        $_GET['page'] = 1;
}
for ($i = 1; $i <= $pages; $i++) {
    if ($i == $_GET['page']) {
        $page .= " <li class='page-item active'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i'>" . $i . "</a></li>";
    } else {
        $page .= "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i'>$i</a></li>";
    }
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
                    <li class="active"><a href="<?php echo $checkout_address ?>">訂單查詢</a></li>
                    <li><a href="<?php echo $cart_address ?>">購物車</a></li>
                    <li><a href="<?php echo $user_address ?>">會員資料</a></li>
                </ul>
            </nav>
            <?php include("button.php"); ?>
        </header>
        <!-- Header Area End -->

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2>訂單查詢</h2>
                            <h4>共有<?php echo $num ?>筆訂單，目前顯示第<?php echo $_GET['page']; ?>筆</h4>
                        </div>

                        <div class="cart-table clearfix">
                            <?php echo $data ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <!-- Pagination -->
                        <nav aria-label="navigation">
                            <ul class="pagination justify-content-end mt-50">
                                <?php echo $page ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ##### Main Content Wrapper End ##### -->

    <?php include("footer.php"); ?>

</body>

</html>