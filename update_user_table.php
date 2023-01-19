<?php
    include("session.php");
    include("connection.php");
    include("privilege.php");
    if(!empty($_POST['pri']))
        $pri = $_POST['pri'];
    else
        $pri = 2;

    //資料庫新增存檔
    if (isset($_POST['name'])) {
        $sql = "update user set password = '".$_POST['passw']."', email = '".$_POST['email']."', u_name = '".$_POST['name']."', phone = '".$_POST['phone']."', privilege = '".$pri."' where account = '".$_POST['account']."'";

        if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
        {
            $msg = "資料新增成功!";
            echo $msg;
        } else {
            $msg = "資料新增失敗！錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link);
            echo $msg;
        }
    }
    mysqli_close($link); // 關閉資料庫連結
    echo $sql;
    if($priv == 3)
        $url = "user_admin.php";
    else
        $url = "user.php";
    header("Location:$url");

?>