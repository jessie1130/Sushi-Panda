<?php 
$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$user = $_POST['account'];

if ($result = mysqli_query($link, "DELETE FROM user where account ='$user'")){
    $url = $_SERVER['HTTP_REFERER'];
    header("Location:$url");
}
else{
    echo $content;
}
?>