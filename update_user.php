<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
// 資料庫查詢(送出查詢的SQL指令)
$account = $_POST['account'];
if ($result = mysqli_query($link, "SELECT * FROM user where account = '$account'")){
    $row = mysqli_fetch_assoc($result);
    $name = $row['u_name'];
    $mail = $row['email'];
    $passw = $row['password'];
    $phone = $row['phone'];
    $pri = $row['privilege'];
}


mysqli_close($link); // 關閉資料庫連結

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>
    <script>
        function sendRequest() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) {
                        document.getElementById('show_msg').innerHTML = $('#account').val() + '已存在';
                    } else {
                        document.getElementById('show_msg').innerHTML = '';
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
                    <li class="active"><a href="<?php echo $user_address ?>">會員資料</a></li>
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
                        <h2>會員資料修改 </h2>
                        </div>
                        <div class="checkout_details_area mt-50 clearfix">
                            <form id="form1" name="form1" action="update_user_table.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="姓名" value="<?php echo $name ?>">
                                        </label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="error"></label>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="手機號碼" value="0<?php echo $phone ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="error"></label>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $mail ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="error"></label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="account" name="account" placeholder="帳號" value="<?php echo $account ?>" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <span id='show_msg' style="color:#FF9F05"></span>
                                        <label for="account" class="error"></label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" id="passw" name="passw" placeholder="密碼" value="<?php echo $passw ?>">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="passw" class="error"></label>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <input type="radio" id="pri" name="pri" value='3' <?php if ($pri == 3) echo "checked" ?>> 管理員
                                        <input type="radio" id="pri" name="pri" value='2' <?php if ($pri == 2) echo "checked" ?>> 一般會員
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="pri" class="error"></label>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <button type="submit" class="btn btn-outline-info btn-xs" id="btn-save">修改</button>
                                        <a href="user_admin.php"><button type="button" class="btn btn-outline-danger btn-xs" id="btn-cancel">取消</button></a>
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