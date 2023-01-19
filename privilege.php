<?php 
if ($result1 = mysqli_query($link, "SELECT * FROM user where account='$user'")) {
    $row1 = mysqli_fetch_assoc($result1);
    if (!empty($row1)) {
        $priv = $row1["privilege"];
        $u_name = $row1["u_name"];
    } else {
        $priv = 1;
    }
} else {
    $priv = 1;
}
?>