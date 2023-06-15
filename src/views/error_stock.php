<?php $title = "IShoes - stock error" ?>
<?php if (!isset($_SESSION['logged']) || !$_SESSION['logged']) { ?>
    <div class="topnav">
        <a href="<?= route('users/login/') ?>"><img src="/images/login.png" height="50"><br>login</a>
        <a href="<?= route('articles/basket/') ?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
    <?php
} else {
    ?>
    <div class="topnav">
        <a href="<?= route('users/logout/') ?>">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user'] ?></a>
        <a href="<?= route('users/basket/') ?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="<?= route('articles/admin/') ?>"><img src="/images/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="/images/logo.png" height="90">
    </div>
<?php } ?>
<h1>Erreur</h1>
<p>Désolé, nous n'avons plus ce produit en stock !</p>
<div id="container">
    <a href="<?= route('articles/home/') ?>"><input type="submit" name="insert" id="insert" value="revenir sur la page d'accueil"></a>
</div>
