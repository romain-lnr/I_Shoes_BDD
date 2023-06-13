<?php
/**
 * Created by Romain Lenoir.
 * Date: 15.03.2023
 * Desc: historic page for show the historic of users -- ONLY for admin
 */

$title="IShoes - historic page"; ?>
    <div class="topnav">
        <a href="index.php?action=logout">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="index.php?action=basket"><img src="../media/img/basket.png" height="50"><br>Basket</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="index.php?action=admin"><img src="../media/img/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="../media/img/logo.png" height="90">
    </div>
    <br>
    <?php $topnav = ob_get_clean();
    ob_start();
    for ($j = 0; $j < $i; $j++) {
        echo "<h1>".$msg[$j]."</h1>";
    }
    $content = ob_get_clean();
    ob_start(); ?>