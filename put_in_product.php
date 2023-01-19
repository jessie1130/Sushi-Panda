<?php

    $link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
        or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    $name = $_POST['name'];
    $content = $_POST['content'];
    $price = $_POST['price'];
    $picture = $_FILES['picture']['name'];

    copy($_FILES['picture']['tmp_name'],"./img/" . $_FILES['picture']['name']);
    unlink($_FILES['picture']['tmp_name']);
    if ($result = mysqli_query($link, "SELECT * FROM product")){
        $num = mysqli_num_rows($result)+1;
    }

    //資料庫新增存檔
    $sql = "insert into product values ('" . $num . "','" . $name . "','" . $picture . "','" . $content . "','" . $price . "')";

    if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
    {
        $msg = "資料新增成功!";
    } else {
        $msg = "資料新增失敗！錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link);
    }
    
    mysqli_close($link); // 關閉資料庫連結
    $url = $_SERVER['HTTP_REFERER'];
header("Location:$url");

?>