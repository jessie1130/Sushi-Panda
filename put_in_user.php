<?php

    $link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
        or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    if(!empty($_POST['pri']))
        $pri = $_POST['pri'];
    else
        $pri = 2;

    //資料庫新增存檔
    if (isset($_POST['name'])) {
        $sql = "insert into user values ('" . $_POST['account'] . "','" . $_POST['passw'] . "','" . $_POST['email'] . "','" . $_POST['name'] . "','" . $_POST['phone'] . "','".$pri."')";

        if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
        {
            $msg = "資料新增成功!";
        } else {
            $msg = "資料新增失敗！錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link);
        }
    }
    
    mysqli_close($link); // 關閉資料庫連結
    if(!empty($_POST['user']))
        $url = $_SERVER['HTTP_REFERER'];
    else 
        $url = "login.php";
header("Location:$url");

?>