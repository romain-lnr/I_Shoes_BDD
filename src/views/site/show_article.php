<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: show_article page for displays the user request article.
 */

// tampon de flux stocké en mémoire
$title = "IShoes - show_article page";
ob_start();
?>
<?php if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
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
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user'] ?></a>
        <a href="index.php?action=basket"><img src="../media/img/basket.png" height="50"><br>Basket</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="index.php?action=admin"><img src="../media/img/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="../media/img/logo.png" height="90">
    </div>
    <br>
    <?php $topnav = ob_get_clean();
}
ob_start(); ?>
<div id="content">
    <form action="index.php?receive_show_article=<?= strval($id) ?>" method="POST">
        <div class="row">
            <div class="col-sm-3">
                <div class="case">
                    <div id="image_article_case"><img src="<?= $article_specs[0][0] ?>" id="image_article"></div>
                    <hr>
                    <div class="body_case">
                        <div id="nom_article"><?= "<em>" . $article_specs[0][1] . "</em>" ?></div>
                        <div id="mark_article"><?= "<em>" . $article_specs[0][2] . "</em>" ?></div>
                        <div id="price_article"><?= "<em>" . $article_specs[0][4] . " CHF" . "</em>" ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="case case_desc">
                    <p><?= $article_specs[0][3] ?></p>
                    <div id="container">
                        <input type="submit" class="form-control" name="insert" id="insert" value="Ajouter au panier">
                        <input type="number" name="value" class="form-control" placeholder="value">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>