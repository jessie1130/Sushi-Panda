<?php
    session_start();
    if (isset($_SESSION['cart'])) {
        $cnt = count($_SESSION['cart']);
    } else {
        $cnt = 0;
    }


    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    else
        $user = "";


    if (isset($_SESSION['wish'])) {
        $cnt_wish = count($_SESSION['wish']);
    }
    else
        $cnt_wish = 0;
?>