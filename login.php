<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>

    <style>
        .error {
            color: #FF9F05;
            font-weight: normal;
            font-family: "微軟正黑體";
            display: inline;
            padding: 1px;
        }
    </style>

    <script>
        $(document).ready(function($) {

            $("#form1").validate({
                submitHandler: function(form) {
                    sendRequest();
                    alert("success!");
                    form.submit();
                },
                rules: {

                    account: {
                        minlength: 4,
                        maxlength: 10,
                        required: true
                    },
                    passw: {
                        minlength: 6,
                        maxlength: 12,
                        required: true
                    }
                },
                messages: {

                    account: {
                        required: "帳號為必填欄位",
                        minlength: "帳號最少要4個字",
                        maxlength: "帳號最長10個字"
                    },
                    passw: {
                        required: "密碼為必填欄位",
                        minlength: "密碼最少要6個字",
                        maxlength: "密碼最長12個字"
                    }
                }

            });
        });
    </script>
</head>

<body>

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <!-- Mobile Nav (max width 767px)-->
        <div class="mobile-nav">
            <!-- Navbar Brand -->
            <div class="amado-navbar-brand">
                <a href="index.php"><img src="img/logo2.png" alt=""></a>
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
                <a href="index.php"><img src="img/logo2.png" alt=""></a>
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
                    <!--<li class="active"><a href="registered.php">註冊</a></li>-->
                    <!--<li><a href="checkout.php">登入</a></li>-->
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
                                <h2>會員登入</h2>
                            </div>
                            <div>
                                <span><?php
                                        if (!empty($_GET['sus'])) {
                                            echo "帳號或密碼不正確，請重新輸入<br>";
                                        }
                                        ?></span>
                            </div>
                            <form id="form1" action="check_login.php" method="GET">
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="account" name="account" placeholder="帳號" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="account" class="error"></label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="password" class="form-control" id="passw" name="passw" placeholder="密碼" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="passw" class="error"></label>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <!--<a href="" class="btn amado-btn w-100" type="submit">註冊</a>-->
                                        <span style="display:block">
                                            <button type="submit" class="btn amado-btn w-100"> 登入 </button>
                                        </span>

                                    </br>
                                    
                                   
                                        <span style="display:block">
                                            <a href="registered.php" class="btn amado-btn active " margin="10px"> 註冊新帳號 </a>
                                        </span>

                                    </br>
                                    
                                        <span >
                                            <a href="forgot_password.php" class="btn amado-btn active " margin="10px"> 忘記密碼 </a>
                                        </span>
                                    </div>

                                </div>
                            </form>
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