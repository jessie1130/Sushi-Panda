<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php

$msg = "";
//資料庫新增存檔
if (!empty($_POST['content']) && isset($_POST['check'])) {

    $content = $_POST['content'];

    date_default_timezone_set('Asia/Taipei');
    $year = date('Y');
    $month = date('m');
    $day = date('d');
    $date = "$year-$month-$day";

    $sqLL = "INSERT INTO board (account, content, board_date) VALUES ('$user', '$content', '$date');";
    $result = mysqli_query($link, $sqLL); // 送出查詢的SQL指令

}

// 資料庫查詢(送出查詢的SQL指令)
$sql = "SELECT *  FROM board order by board_date";
$data = "";

if ($result = mysqli_query($link, $sql)) {
    $total_records = mysqli_num_rows($result);
    for ($j = 1; $j <= $total_records; $j++) {
        $row = mysqli_fetch_assoc($result);

        $data .= "<div class='card'>
                        <div class='card-header'>
                            用戶名：" . $row["account"] . "    時間: " . $row["board_date"] . "
                        </div>
                        <div class='card-body'>
                                    
                            <p class='card-text'>" . $row["content"] . " </p>
                                
                        </div>
                    </div>
                    </br>";
    }
    mysqli_free_result($result); // 釋放佔用的記憶體
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

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="checkout_details_area mt-50 clearfix">

                            <div class="cart-title">
                                <h2>留言板</h2>
                                <h4>共 <?php echo $total_records ?> 則留言</h4>
                            </div>
                            </br>

                            <?php echo $data ?>

                            </br>
                            </br>
                            </br>
                            </br>

                            <form action="" method="post">
                                <div class="row">
                                    <!--<div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="account" value="" placeholder="請輸入帳號名稱..." required>
                                    </div>-->


                                    <div class="col-12 mb-3">
                                        <textarea name="content" class="form-control w-100" id="comment" cols="30" rows="10" placeholder="在此輸入你的留言..."></textarea>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <button type="submit" name="check" class="btn amado-btn w-100">發表留言</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->


    <?php include("footer.php"); ?>

</body>

</html>