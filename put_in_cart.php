<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = Array();
}

$id = $_GET['id'];//商品ID
$amount = $_GET['quantity'];
//若商品未在購物車中,則加入購物車(陣列)
for($i=0;$i < count($_SESSION['cart']);$i++){
    if($id == $_SESSION['cart'][$i][0]){
        $_SESSION['cart'][$i][1] = (int)$_SESSION['cart'][$i][1]+(int)$amount;
        break;
    }
}
if($i >= count($_SESSION['cart'])){
    $i = count($_SESSION['cart']);
    $_SESSION['cart'][$i][0]=$id;//加入陣列
    $_SESSION['cart'][$i][1]=$amount;//加入陣列
}

if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){//搜尋陣列元素並移除該元素
        for($k=0; $k<count($_SESSION['cart']); $k++){
            if($id == $_SESSION['cart'][$k][0]){
                unset($_SESSION['cart'][$k]);
                break;
            }
        }
        $_SESSION['cart']=array_values($_SESSION['cart']);//重新排列陣列順序
    }
    if($_GET["action"] == "change"){
        $amount = $_GET["qty"];
        for($k=0; $k<count($_SESSION['cart']); $k++){
            if($id == $_SESSION['cart'][$k][0]){
                $_SESSION['cart'][$k][1]=$amount;
                break;
            }
        }
    }
}



//返回上一頁
$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");
//檢查內容，要檢查的話，先把返回上一頁註解
/*for($i=0;$i < count($_SESSION['cart']);$i++){
    echo $_SESSION['cart'][$i][0]." ";
    echo $_SESSION['cart'][$i][1]."\n\r";
}*/

?>