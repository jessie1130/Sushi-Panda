<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php
// // 資料庫查詢(送出查詢的SQL指令)
if (!empty($_GET['select'])) {
    $mode = $_GET['select'];
} else {
    $mode = "id";
}
if (!empty($_GET['select2'])) {
    $view = $_GET['select2'];
} else {
    $view = "8";
}
if ($priv < 3) {
    $product_address = "product-details.php";
} else {
    $product_address = "product-details_admin.php";
}
$id = "";

$page = "";
$pages = "";
if (!empty($_GET['search']) && isset($_GET['ser_btn'])) {
    $find = $_GET['search'];
    $data = "";

    if ($result1 = mysqli_query($link, "SELECT * FROM product where p_name like '%$find%' ")) {
        $num = mysqli_num_rows($result1); //查詢結果筆數

        if ($num > 8) {
            $pages = ceil($num / 8);
            if (!empty($_GET['page']))
                mysqli_data_seek($result1, ($_GET['page'] - 1) * 8);
            $num = 8;
        }


        for ($j = 1; $j <= $num; $j++) {
            $row = mysqli_fetch_assoc($result1);
            $id = $row["ID"];

            $data .= "<div class='col-12 col-sm-6 col-md-12 col-xl-6'>
                <div class='single-product-wrapper'>
                    <div class='product-img'>
                    <a href ='$product_address?id=$id'><img src='img/" . $row["picture"] . "' alt=''></a>
                    </div>
                    <div class='product-description d-flex align-items-center justify-content-between'>
                        <div class='product-meta-data'>
                            <div class='line'></div>
                            <p class='product-price'>" . $row["price"] . "元</p>
                            <a href ='product-details.php?id=$id'>
                            
                            <h6>" . $row["p_name"] . "</h6>
                            </a>
                        </div>
                    </div>
                </div></div>";
        }
        if ($data == "") {
            $data = "找不到符合商品";
        }
        mysqli_free_result($result1);
    }
} else {
    if ($result = mysqli_query($link, "SELECT * FROM product order by $mode ")) {
        $data = "";
        $num = mysqli_num_rows($result); //查詢結果筆數
        $pages = ceil($num / $view);
        if (!empty($_GET['page']))
            mysqli_data_seek($result, ($_GET['page'] - 1) * $view);
        for ($j = 1; $j <= $view; $j++) {
            $row = mysqli_fetch_assoc($result);
            if (empty($row)) break;
            $id = $row["ID"];
            $data .= "<div class='col-12 col-sm-6 col-md-12 col-xl-6'>
                <div class='single-product-wrapper'>
                    <div class='product-img'>
                    <a href ='$product_address?id=$id'><img src='img/" . $row["picture"] . "' alt=''></a>
                    </div>
                    <div class='product-description d-flex align-items-center justify-content-between'>
                        <div class='product-meta-data'>
                            <div class='line'></div>
                            <p class='product-price'>" . $row["price"] . "元</p>
                            <a href ='product-details.php?id=$id'>
                            
                            <h6>" . $row["p_name"] . "</h6>
                            </a>
                        </div>
                    </div>
                </div></div>";
        }
        mysqli_free_result($result);
    }
}
mysqli_close($link); // 關閉資料庫連結
$page = "";
if (empty($_GET['page']))
    $_GET['page'] = 1;
for ($i = 1; $i <= $pages; $i++) {
    if ($i == $_GET['page']) {
        $page .= " <li class='page-item active'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i&select=$mode&select2=$view'>" . $i . "</a></li>";
    } else {
        $page .= "<li class='page-item'><a class='page-link' href='" . $_SERVER['PHP_SELF'] . "?page=$i&select=$mode&select2=$view'>$i</a></li>";
    }
}
//<a href='product-details.php?id=" .$row["id"]."'>30
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("header.php"); ?>
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
                            <input type="search" name="search" id="search" placeholder="輸入商品關鍵字...">
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
                    <li class="active"><a href="shop.php">商品</a></li>
                    <?php include("privilege_address.php"); ?>
                    <li><a href="<?php echo $checkout_address ?>">訂單查詢</a></li>
                    <li><a href="<?php echo $cart_address ?>">購物車</a></li>
                    <li><a href="<?php echo $user_address ?>">會員資料</a></li>
                </ul>
            </nav>
            <?php include("button.php"); ?>
        </header>
        <!-- Header Area End -->



        <div class="amado_product_area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                            <!-- Total Products -->
                            <?php 
                                if($priv == 3)
                                    $new = "";
                                else
                                    $new = "display:none;";
                            ?>
                            <div>
                                <a href="#" class="search-nav" style="font-size: 20px;"><img src="img/core-img/search.png" width="20" height="20" alt=""> 搜尋商品 </a>
                            </br>
                                <a href="new_product.php" style="font-size: 20px;<?php echo $new?>"> <img src="img/core-img/add.png" width="20" height="20" alt=""> 新增商品</a>
                            </div>
                            <!-- Sorting -->
                            <form action="" method="get" onChange="submit()">
                                <div class="product-sorting d-flex">
                                    <div class="sort-by-date d-flex align-items-center mr-15">
                                        <p>Sort by</p>
                                        <select name="select" id="sortBydate">
                                            <?php
                                            if (empty($_GET['select'])) {
                                                echo "<option value='id' selected>商品序號</option>";
                                                echo "<option value='price'> 價錢 </option>";
                                                echo "<option value='p_name'>名稱</option>";
                                            } else {
                                                if ($_GET['select'] == 'id') {
                                                    echo "<option value='id' selected>商品序號</option>";
                                                    echo "<option value='price' > 價錢 </option>";
                                                    echo "<option value='p_name'>名稱</option>";
                                                } else if ($_GET['select'] == 'price') {
                                                    echo "<option value='id'>商品序號</option>";
                                                    echo "<option value='price' selected> 價錢 </option>";
                                                    echo "<option value='p_name'>名稱</option>";
                                                } else if ($_GET['select'] == 'p_name') {
                                                    echo "<option value='id' >商品序號</option>";
                                                    echo "<option value='price'> 價錢 </option>";
                                                    echo "<option value='p_name' selected>名稱</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="view-product d-flex align-items-center">
                                        <p>View</p>
                                        <select name="select2" id="viewProduct">
                                            <?php
                                            if (empty($_GET['select2'])) {
                                                echo "<option value='6'>6</option>";
                                                echo "<option value='8' selected> 8 </option>";
                                                echo "<option value='12'>12</option>";
                                            } else {
                                                if ($_GET['select2'] == '6') {
                                                    echo "<option value='6' selected>6</option>";
                                                    echo "<option value='8' > 8 </option>";
                                                    echo "<option value='12'>12</option>";
                                                } else if ($_GET['select2'] == '8') {
                                                    echo "<option value='6'>6</option>";
                                                    echo "<option value='8' selected> 8 </option>";
                                                    echo "<option value='12'>12</option>";
                                                } else if ($_GET['select2'] == '12') {
                                                    echo "<option value='6' >6</option>";
                                                    echo "<option value='8'> 8 </option>";
                                                    echo "<option value='12' selected>12</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php echo $data ?>
                </div>

                <div class="row">
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