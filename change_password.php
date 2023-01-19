<?php
    include("session.php");
    include("connection.php");
    include("privilege.php");
   

    //資料庫新增存檔
    if (isset($_POST['passw'])) {
        $sql = "update user set password = '".$_POST['passw']."' where email = '".$_POST['email']."'";

        if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
        {
            $msg = "密碼更新成功!";
        } else {
            $msg = "資料新增失敗！錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link);
            echo $msg;
        }
    }
    mysqli_close($link); // 關閉資料庫連結
    echo "<script>alert('$msg'); location.href = 'login.php';</script>";

?>