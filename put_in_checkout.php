<?php
    session_start();
    $user = $_SESSION['user'];
    $product = $_POST['product'];
    $amount = $_POST['amount'];
    $total = $_POST['total'];
    $date = $_POST['date'];
    $link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
        or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    //資料庫新增存檔
    do{
        $a=rand(0,2147483647);
        $sql = "SELECT * FROM checkout where checkout_id = '$a' ";
        if ($result1 = mysqli_query($link, $sql)){
            $row = mysqli_fetch_assoc($result1);
        }
    }while($a == $row['checkout_id']);
    
    $sql = "insert into checkout values ('".$a."','" . $user . "','" . $_POST['product'] . "','" . $_POST['amount'] . "','" . $_POST['total'] . "','" . $_POST['date'] . "')";

    if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
    {
        $msg = "資料新增成功!";
    } else {
        $msg = "資料新增失敗！錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link);
    }
    $cnt = count($_SESSION['cart']);
    for ($j = 0; $j < $cnt; $j++){
        unset($_SESSION['cart'][$j]);
    }
    mysqli_close($link); // 關閉資料庫連結
    $url = "cart.php";
header("Location:$url");

?>