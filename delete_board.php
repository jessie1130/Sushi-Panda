<?php 
$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

$user = $_POST['user'];
$date = $_POST['date'];
$content = $_POST['content'];

if ($result = mysqli_query($link, "DELETE FROM board where account ='$user' and content = '$content' and board_date = '$date'")){
    $url = $_SERVER['HTTP_REFERER'];
    header("Location:$url");
}
else{
    echo $content;
}
?>