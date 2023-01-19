<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php

$code = 123456;
$data = "";
$msg = "";
$a = "";
$mail="";
if(isset($_POST['send_verif'])){
    $mail = $_POST['email'];

    ini_set('SMTP', 'aspmx.l.google.com');
    ini_set('sendmail_from', 'jiayihsu0518@gmail.com');

    $headers = 'sushi panda';

    mail("$mail", 'sushi panda', $code, $headers)
    or die("郵件傳送失敗！");;
    
    /*$subject="=?UTF-8?B?".base64_encode('主旨')."?=";//信件標題，解決亂碼問題
    mail('$mail', $subject,'$code')
    or die("郵件傳送失敗！");*/
    
    $result = mysqli_query($link, "SELECT * FROM user where email = '$mail'");
    $row = mysqli_fetch_assoc($result);
    if($row == 0){$msg .= "電子郵件錯誤，請重新輸入/重送電子郵件";}
    

}
else if(isset($_POST['change_pass'])){
    $mail = $_POST['email'];
    if($code == $_POST['verif_code']){
        $result = mysqli_query($link, "SELECT * FROM user where email = '$mail'");
        $row = mysqli_fetch_assoc($result);
        
        if($row != 0){
            $account = $row['account'];
            $u_name = $row['u_name'];

            $data="<form id='form2' action='change_password.php' method='POST'>
                    <table width='700px' class='table table-striped '>
                    <tr >
                        <td >帳號</td>
                        <td >姓名</td>
                        <td >Email</td>
                        
                    </tr>
                    <tr >
                        <td >$account</td>
                        <td >$u_name</td>
                        <td ><input type='email' id='email' name='email' value='$mail' style='border:0' ></td>     
                    </tr>
                    <tr >
                        <td >輸入新密碼</td>
                        <td ></td>
                        <td >密碼確認</td>
                    </tr>
                    <tr >
                        <td><input type='password' id='passw' name='passw'><label for='passw' class='error'></label>
                        </td>
                        <td></td>
                        <td><input type='password' id='passw2' name='passw2'><label for='passw2' class='error'></label>
                        </td>
                    </tr>

                    </table>

                    
                     

                    <button type='submit' name='change' class='btn btn-outline-warning d-grid gap-2 col-12 mx-auto'> 確認 </button>
                </form>";
        }
        else{
            $data = "電子郵件錯誤，請重新輸入/重送電子郵件";
        }     
    }
    else{
        $data = "輸入錯誤，請重新輸入/重送驗證碼";
    }
}
?>
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
                    email:{
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
                    email:{
                        required: "電子郵件為必填欄位"
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
             $("#form2").validate({
                submitHandler: function(form) {
                    sendRequest();
                    alert("success!");
                    form.submit();
                },
                rules: {
                    
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
                                <h2>忘記密碼</h2>
                            </div>
                            <div>
                               
                            </div>
                            <form id="form1" action="" method="POST">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $mail ?>">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button type="submit" name="send_verif" class="btn amado-btn w-100"> 送出驗證碼 </button>   
                                    </div>
                                     <div class="col-12 mb-3">
                                        <?php echo $msg ?>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="email" class="error"></label>
                                    </div>
                            </form>

                                    <div class="col-md-8 mb-3">
                                        <input type="text" class="form-control" id="verif_code" name="verif_code" placeholder="請輸入驗證碼" value="">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <button type="submit" name="change_pass" class="btn amado-btn w-100"> 確認 </button>   
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="verif_code" class="error"></label>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <?php echo $data ?>
                                    </div>
                                        

                                        
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
