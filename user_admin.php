<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
// 資料庫查詢(送出查詢的SQL指令)
$id = "";
$product = "";

if (!empty($_GET['search']) && isset($_GET['ser_btn'])) {
    $find = $_GET['search'];
    $data = "";

    if ($result1 = mysqli_query($link, "SELECT * FROM user where account like '%$find%' ")) {
        $num = mysqli_num_rows($result1); //查詢結果筆數
        $pages = ceil($num / 10);
        if (!empty($_GET['page']))
            mysqli_data_seek($result1, ($_GET['page'] - 1) * 10);

        for ($j = 0; $j < 10; $j++) {
            $row = mysqli_fetch_assoc($result1);
            if (empty($row)) break;
            $name = $row['u_name'];
            $account = $row['account'];
            $phone = $row['phone'];
            $mail = $row['email'];
            $identity = ($row['privilege'] > 2) ? "管理員" : "一般會員";
            $data .= "
                    <tr align='center'>
                        <td>" . $account . "</td>
                        <td>" . $name . "</td>
                        <td>0" . $phone . "</td>
                        <td>" . $mail . "</td>
                        <td>" . $identity . "</td>
                        <td><form action='update_user.php' method='POST' style='display:inline;'><input name='account' value='" . $row['account'] . "' style='display: none;'>
                        <button onClick='submit()' class='btn btn-outline-secondary'>修改</button></form>
                        <form action='delete_user.php' method='POST' style='display:inline;'><input name='account' value='" . $row['account'] . "' style='display: none;'>
                        <button onClick='submit()' class='btn btn-outline-danger'>刪除</button></form></td>
                    </tr>";
        }

        mysqli_free_result($result1);
    }
    $page = "";
    if (empty($_GET['page'])) {
        if ($pages == 0)
            $_GET['page'] = 0;
        else
            $_GET['page'] = 1;
    }
    for ($i = 1; $i <= $pages; $i++) {
        if ($i == $_GET['page']) {
            $page .= " <li class='page-item active'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i&search=$find&ser_btn=#'>" . $i . "</a></li>";
        } else {
            $page .= "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i&search=$find&ser_btn=#'>$i</a></li>";
        }
    }
} else {
    if ($result = mysqli_query($link, "SELECT * FROM user ")) {
        $data = "";
        $num = mysqli_num_rows($result); //查詢結果筆數
        $pages = ceil($num / 10);
        if (!empty($_GET['page']))
            mysqli_data_seek($result, ($_GET['page'] - 1) * 10);
       
        for ($i = 0; $i < 10; $i++) {
            $row = mysqli_fetch_assoc($result);
            if (empty($row)) break;
            $name = $row['u_name'];
            $account = $row['account'];
            $phone = $row['phone'];
            $mail = $row['email'];
            $identity = ($row['privilege'] > 2) ? "管理員" : "一般會員";
            $data .= "
                    <tr align='center'>
                        <td>" . $account . "</td>
                        <td>" . $name . "</td>
                        <td>0" . $phone . "</td>
                        <td>" . $mail . "</td>
                        <td>" . $identity . "</td>
                        <td>
                        <form action='update_user.php' method='POST' style='display:inline;' ><input name='account' value='" . $row['account'] . "' style='display: none;'>
                        <button onClick='submit()' class='btn btn-outline-secondary'>修改</button></form>
                        
                        <form action='delete_user.php' method='POST' style='display:inline;' ><input name='account' value='" . $row['account'] . "' style='display: none;'>
                        <button onClick='submit()' class='btn btn-outline-danger'>刪除</button></form></td>
                        
                    </tr>";
        }

        mysqli_free_result($result);
    }
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
}
mysqli_close($link); // 關閉資料庫連結

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>
    <script>
        $(document).ready(function() {
            <?php $dis = "<button type='submit' class='btn btn-outline-info btn-xs' id='btn-save'>新增</button>"; ?>
            document.getElementById('btn_type').innerHTML = "<?php echo $dis ?>";

        });
        function sendRequest() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 1) {
                        document.getElementById('show_msg').innerHTML = $('#account').val() + '已存在';
                        <?php $dis = "<button type='submit' class='btn btn-outline-info btn-xs' id='btn-save' disabled='disabled'>新增</button>"; ?>
                        document.getElementById('btn_type').innerHTML = "<?php echo $dis ?>";
                    }
                    else {
                        document.getElementById('show_msg').innerHTML = '';
                        <?php $dis = "<button type='submit' class='btn btn-outline-info btn-xs' id='btn-save'>新增</button>"; ?>
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
                    pri:{
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
                    },
                    pri:{
                        required: "請設定權限",
                    }
                }

            });
        });
    </script>
    <style>
        .error {
            color: #FF9F05;
            font-weight: normal;
            font-family: "微軟正黑體";
            display: inline;
            padding: 1px;
        }
    </style>
</head>

<body>
    <!-- Search Wrapper Area Start -->
    <div class="search-wrapper section-padding-100">
        <div class="search-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-content">
                        <form action="#" method="get">
                            <input type="search" name="search" id="search" placeholder="輸入會員帳號...">
                            <button type="submit" name="ser_btn"><img src="img/core-img/search.png" alt=""></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Search Wrapper Area End -->

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
                    <div class="col-12">
                        <div class="cart-title mt-50">
                        <h2>會員資料 <a href="#" class="search-nav" style="font-size: 20px; color:gray;"><img src="img/core-img/search.png" width="20" height="20" alt=""> 搜尋會員帳號</a></h2>
                        </div>
                    </br></br>

                        <form name="form1" id="form1" method="POST" action="put_in_user.php">
                            <table id="edit" class="table-responsive">
                                <tr align='center'>
                                    <td>姓名</td>
                                    <td>手機號碼</td>
                                    <td>E-mail</td>
                                    <td>帳號</td>
                                    <td>密碼</td>
                                    <td>管理員/一般會員</td>
                                    <td>新增/取消</td>
                                </tr>
                                <tr align='center'>
                                    <td >
                                        <input type="text" id="name" name="name">
                                        <br><label for="name" class="error"></label>
                                    </td>
                                    <td>
                                        <input type="text" id="phone" name="phone">
                                        <br><label for="phone" class="error"></label>
                                    </td>
                                    <td>
                                        <input type="text" id="email" name="email">
                                        <br><label for="email" class="error"></label>
                                    </td>
                                    <td>
                                        <input type="text" id="account" name="account" onkeyup="sendRequest()">
                                        <br><label for="account" class="error"></label>
                                        <span id='show_msg' class="error"></span>
                                    </td>
                                    <td>
                                        <input type="password" id="passw" name="passw">
                                        <br><label for="passw" class="error"></label>
                                    </td>
                                    <td>
                                        <input type="radio" id="pri" name="pri" value='3'> 管理員
                                        <input type="radio" id="pri" name="pri" value='2'> 一般會員
                                        <br><label for="pri" class="error"></label>
                                    </td>
                                    <td>
                                        <input value="1" name="user" id="user" style="display: none;">
                                        <span id="btn_type"></span>
                                        <button type="reset" class="btn btn-outline-danger btn-xs" id="btn-cancel">取消</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </br></br></br>
                        <h4>共有<?php echo $num ?>個會員，目前顯示第<?php echo $_GET['page']; ?>頁</h4>

                        <!-- <div class="cart-table clearfix">-->
                        <div class="table-responsive">
                            <table width="700px" class="table table-striped"> 
                                <tr align='center' class="table table-warning" >
                                    <td>會員帳號</td>
                                    <td>會員姓名</td>
                                    <td>連絡電話</td>
                                    <td>連絡email</td>
                                    <td>權限</td>
                                    <td>修改/刪除</td>

                                </tr>
                                <?php echo $data ?>
                            </table>

                        
                        </div >
                        <!-- </div>-->
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