<?php
session_start();
$user = $_SESSION['user'];
$p_id = $_GET['id'];//商品ID
$p_name = "";
$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
        or die("無法開啟MySQL資料庫連結!<br>");

    // 送出編碼的MySQL指令
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

    $find_sql = "SELECT * FROM wish_list where account = '$user' and p_id = '$p_id' ";
    
    if($result1 = mysqli_query($link, $find_sql)){
        $num = mysqli_num_rows($result1); //查詢結果筆數 
        if($num != 0){
            $url = $_SERVER['HTTP_REFERER'];
            header("Location:$url");
        }
        else{
             //資料庫新增存檔
            do{
                $wish_id=rand(0,2147483647);
                $sql = "SELECT * FROM wish_list where id = '$wish_id' ";
                if ($result1 = mysqli_query($link, $sql)){
                    $row = mysqli_fetch_assoc($result1);
                }
            }while($wish_id == $row['id']);

            $sql1 = "SELECT * FROM product where ID = '$p_id' ";
            if($result2 = mysqli_query($link, $sql1)){
                 $row = mysqli_fetch_assoc($result2);
                 $p_name = $row['p_name'];
            }
            

            $sql = "insert into wish_list values ('".$wish_id."','" . $user . "','" . $p_id . "', '" . $p_name . "')";

            if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
            {
                $msg = "資料新增成功!";
            } else {
                $msg = "資料新增失敗！錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link);
            }

            mysqli_close($link); // 關閉資料庫連結
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