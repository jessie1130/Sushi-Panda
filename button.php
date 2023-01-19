<!-- Button Group -->
<?php
if ($priv == 1) {
    $non1 = "";
    $hello = "";
    $non2 = "style='display: none;'";
} else {
    $non1 = "style='display: none;'";
    $hello = $u_name . " 你好^-^";
    $non2 = "";
}
?>
<div class="amado-btn-group mt-30 mb-100">
    <a href="login.php" class="btn amado-btn mb-15" <?php echo $non1 ?>>會員登入</a>
    <span><?php echo $hello ?></span>
    <a href="logout.php" class="btn amado-btn mb-15" <?php echo $non2 ?>>會員登出</a>
</div>
<!-- Cart Menu -->
<div class="cart-fav-search mb-100">
    <a href="<?php echo $cart_address ?>" class="cart-nav"><img src="img/core-img/cart.png" alt=""> 購物車 <span>(<?php echo $cnt; ?>)</span></a>
    <a href="<?php echo $wish_address  ?>" class="fav-nav"><img src="img/core-img/favorites.png" alt=""> 我的最愛</a>
    <a href="<?php echo $board_address ?>" class=""><img src="img/core-img/message.png" alt=""> 留言板</a>
</div>
<!-- Social Button -->
<div class="social-info d-flex justify-content-between">
    <a href="https://www.youtube.com/channel/UCfxrzZZOoCDTw7DcZ3oeqlw" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a>
    <a href="https://www.instagram.com/sushiro.tw/?hl=zh-tw" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
    <a href="https://www.facebook.com/Sushiro.TW/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
    <a href="https://webcourse.ncue.edu.tw/Web/index.php" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i></a>
</div>