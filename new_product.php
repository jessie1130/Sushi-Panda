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
                    form.submit();
                },
                rules: {
                    name: {
                        required: true
                    },
                    price: {
                        required: true
                    },
                    content: {
                        required: true
                    },
                    picture: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "請輸入商品名稱"
                    },
                    price: {
                        required: "請輸入商品價錢"
                    },
                    content: {
                        required: "請輸入商品介紹"
                    },
                    picture: {
                        required: "請上傳商品圖片"
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
                                <h2>新增商品</h2>
                            </div>
                            <form id="form1" name="form1" action="put_in_product.php" method="POST" enctype='multipart/form-data'>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="商品名稱">
                                        </label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="name" class="error"></label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control" id="price" name="price" placeholder="商品價錢" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="price" class="error"></label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <input type="text" class="form-control w-100" id="content" name="content" placeholder="商品內容" value="" cols="30" rows="10">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="content" class="error"></label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <input type="file" class="form-control" id="picture" name="picture" placeholder="商品圖片" value="">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="picture" class="error"></label>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type='submit' class='btn amado-btn w-100' > 確定新增 </button>
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