<?php
if ($priv == 1) {
    $checkout_address = "login.php";
    $cart_address = "login.php";
    $board_address = "login.php";
    $user_address = "login.php";
    $wish_address = "login.php";
} else if ($priv == 2) {
    $checkout_address = "checkout.php";
    $cart_address = "cart.php";
    $board_address = "board.php";
    $user_address = "user.php";
    $wish_address = "wish.php";
} else if ($priv == 3) {
    $checkout_address = "checkout_admin.php";
    $cart_address = "cart.php";
    $board_address = "board_admin.php";
    $user_address = "user_admin.php";
    $wish_address = "wish.php";
}
?>