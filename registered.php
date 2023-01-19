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
        $(document).ready(function() {
            <?php $dis = "<button type='submit' class='btn amado-btn w-100' > 註冊帳號 </button>"; ?>
            document.getElementById('btn_type').innerHTML = "<?php echo $dis ?>";

        });
    </script>
    <script>
        function sendRequest() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) {
                        document.getElementById('show_msg').innerHTML = $('#account').val() + '此帳號已存在，請使用其他名稱';
                        <?php $dis = "<button type='submit' class='btn amado-btn w-100' disabled='disabled'> 註冊帳號 </button>"; ?>
                        document.getElementById('btn_type').innerHTML = "<?php echo $dis ?>";
                    }
                    //document.getElementById('show_msg').innerHTML = '此帳號已存在，請使用其他名稱';
                    else {
                        document.getElementById('show_msg').innerHTML = '';
                        <?php $dis = "<button type='submit' class='btn amado-btn w-100' > 註冊帳號 </button>"; ?>
                        document.getElementById('btn_type').innerHTML = "<?php echo $dis ?>";
                    }
                }
            };
            var url = 'check_account_ajax.php?account=' + document.form1.account.value + '&timeStamp=' + new Date().getTime();
            xhttp.open('GET', url, true); //建立XMLHttpRequest連線要求
            xhttp.send();
        }
        $(document).ready(function($) {

            $("#form1").validate({
                submitHandler: function(form) {
                    form.submit();
                },
                rules: {
                    name: {
                        required: true
                    },
                    phone: {
                        required: true,
                        maxlength: 10,
                        minlength: 10,
                        max: 999999999,
                        min: 900000000
                    },
                    email: {
                        required: true
                    },
                    account: {
                        minlength: 4,
                        maxlength: 10,
                        required: true
                    },
                    passw: {
                        minlength: 6,
                        maxlength: 12,
                        required: true
                    },
                    passw2: {
                        required: true,
                        equalTo: "#passw"
                    }
                },
                messages: {
                    name: {
                        required: "姓名為必填欄位"
                    },
                    phone: {
                        required: "手機為必填欄位",
                        maxlength: "需輸入10個數字",
                        minlength: "需輸入10個數字",
                        max: "需為09開頭",
                        min: "需為09開頭"
                    },
                    email: {
                        required: "電子郵件為必填欄位"
                    },
                    account: {
                        required: "帳號為必填欄位",
                        minlength: "帳號最少要4個字",
                        maxlength: "帳號最長10個字"
                    },
                    passw: {
                        required: "密碼為必填欄位",
                        minlength: "密碼最少要6個字",
                        maxlength: "密碼最長12個字"
                    },
                    passw2: {
                        equalTo: "兩次密碼不相符"
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
                                <h2>註冊</h2>
                            </div>
                            <form id="form1" name="form1" action="put_in_user.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="name" name="name" value="" placeholder="姓名">
                                        </label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="error"></label>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="手機號碼" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="error"></label>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="error"></label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="account" name="account" placeholder="帳號" value="" onkeyup="sendRequest()">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <span id='show_msg' style="color:#FF9F05"></span>
                                        <label for="account" class="error"></label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="password" class="form-control" id="passw" name="passw" placeholder="密碼" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="passw" class="error"></label>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="password" class="form-control" id="passw2" name="passw2" placeholder="密碼確認" value="">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="passw2" class="error"></label>
                                    </div>
                                    <div class="">
                                        <span id="btn_type"></span>
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