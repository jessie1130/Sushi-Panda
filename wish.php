<?php include("session.php"); ?>
<?php include("connection.php"); ?>
<?php include("privilege.php"); ?>
<?php

$p_id="";
$p_name="";
$data = "";
$price = "";

if ($result = mysqli_query($link, "SELECT * FROM wish_list where account ='$user' ")) {
    $num = mysqli_num_rows($result); //查詢結果筆數 

    for ($i = 0; $i < $num; $i++) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row)) {
            $id = $row['id']; //wish list id
            $p_id = $row['p_id'];
            $p_name = $row['p_name'];

            $result2 = mysqli_query($link, "SELECT * FROM product where ID ='".$p_id."'");
            $row2 = mysqli_fetch_assoc($result2);
            if(!empty($row2)){
                $image = $row2['picture'];
                $p_name = $row2['p_name'];

                $data .= "<td class='cart_product_img'>";
                $data .=
                "<tr>
                    <td class='cart_product_img'>
                        <a href='product-details.php?id=$p_id'><img src='img/" . $image . "' alt='Product'></a>
                    </td>
                    <td class='cart_product_desc'>
                        <h5>" . $p_name . "</h5>
                    </td>
                    <td class='price'>
                        <span>".$row2['price']."</span>
                    </td>
                    <td class='qty'>
                        <div class='cart-fav-search mb-100'>
                            <div>
                                <button class='btn btn-outline-danger' type ='button' onclick=location.replace('delete_wish.php?id=" . $id . "');>
                                    從我的最愛移除
                                </button>

                            </div>
                        </div> 
                    </td>
                </tr>";
            }
            else{
                $data .= "<td class='cart_product_img'>";
                $data .=
                "<tr>
                    <td class='cart_product_img'>
                        商品已售完
                    </td>
                    <td class='cart_product_desc'>
                        <h5>$p_name</h5>
                    </td>
                    <td class='price'>
                        
                    </td>
                    <td class='qty'>
                        <div class='cart-fav-search mb-100'>
                            <div>
                                <button class='btn btn-outline-danger' type ='button' onclick=location.replace('delete_wish.php?id=" . $id . "');>
                                    從我的最愛移除
                                </button>

                            </div>
                        </div> 
                    </td>
                </tr>";
            }
            
        } else {
            $num = 0;
        }
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
                        <div class="col-12">
                            <div class="cart-title mt-50">
                                <h2>我的最愛</h2>
                            </div>

                            <div class="cart-table clearfix">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>商品名稱</th>
                                            <th>商品價錢</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $data ?>
                                    </tbody>
                                </table>
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