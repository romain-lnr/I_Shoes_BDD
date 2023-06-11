<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: Home page for see all articles in the JSON file.
 */

$title="IShoes - home page";

if (!isset($_SESSION['logged']) ||  !$_SESSION['logged']) {
    ?>
    <div class="topnav">
        <a href="<?=route('users/login/')?>"><img src="/images/login.png" height="50"><br>login</a>
        <a href="<?=route('articles/basket/')?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
    <?php
} else {
    ?>
    <div class="topnav">
        <a href="index.php?action=logout">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="<?=route('articles/basket/')?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="<?=route('articles/admin/')?>"><img src="/images/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
    <?php
}
?>
<?php if(isset($bag['data'])):?>
    <div id="content">
        <?php if(isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == "not_even_stock") echo "<br><p style='color:red'>Pas assez de stock</p>";
        }?>
        <div class="row">
            <?php foreach ($bag['data'] as $row => $article) : ?>
            <?php $row++; ?>
            <div class="col-sm-3">
                <div class="case" onclick="RedirectWithID(<?=$article['id']?>)">
                    <div id="image_article_case"><img src="<?=$article['Imagepath'];?>" id="image_article"></div>
                    <hr>
                    <div class="body_case">
                        <div id="nom_article"><?="<em>".$article['Name']."</em>";?></div>
                        <div id="mark_article"><?="<em>".$article['Mark']."</em>";?></div>
                        <div id="price_article"><?="<em>".$article['Price']. " CHF". "</em>";?></div>
                    </div>
                </div>
            </div>
                <script>
                    function RedirectWithID($id) {
                        window.location.href = "<?=route("articles/show/article=")?>"+$id;
                    }
                </script>
            <?php endforeach ?>
        </div>
    </div>
<?php endif ?>
