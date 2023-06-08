<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: lost page for when the user is lost
 */

// tampon de flux stocké en mémoire
$title="IShoes - lost page";
ob_start();
?>
    <?php if (!isset($_SESSION['logged']) ||  !$_SESSION['logged']) {
    ob_start(); ?>
    <div class="topnav">
        <a href="index.php?action=login"><img src="../media/img/login.png" height="50"><br>login</a>
        <a href="index.php?action=login"><img src="../media/img/basket.png" height="50"><br>Basket</a>
        <img src="../media/img/logo.png" height="90">
    </div>
    <br>
<?php $topnav = ob_get_clean();
} else {
    ob_start(); ?>
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
    } ?>
    <h1 style="text-align: center">Vous vous êtes perdus, <br>veuillez revenir sur la page d'accueil.</h1><br>
    <?php $content = ob_get_clean();
    ob_start(); ?>