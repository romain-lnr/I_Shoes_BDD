<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The basket page for see all purchases of the currently logged user.
 */

// tampon de flux stocké en mémoire
$title = "IShoes - basket page";
?>

<div class="topnav">
    <a href="<?=route('users/logout/')?>">logout</a>
    <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user'] ?></a>
    <a href="<?= route("articles/home/") ?>"><img src="/images/home.png" height="50"><br>Home</a>
    <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
        <a href="<?= route("articles/admin/") ?>"><img src="/images/admin.png" height="50"><br>Admin</a>
    <?php } ?>
    <img src="/images/logo.png" height="90">
</div>
<br>

<?php
if (!empty($bag['data'])) { ?>
    <?php foreach ($bag['data'] as $row => $article) { ?>
        <?php $row++; ?>
        <div id="content">
            <div class="row">
                <div class="col-sm-3">
                    <div class="case basket">
                        <div id="image_article_case"><img src="<?= $article['Image'] ?>" id="image_article"></div>
                        <hr>
                        <div class="body_case">
                            <div id="nom_article"><?= "<em>" . $article['Name'] . "</em>" ?></div>
                            <div id="mark_article"><?= "<em>" . $article['Mark'] . "</em>" ?></div>
                            <div id="price_article"><?= "<em>" . $article['Price'] . " CHF" . "</em>" ?></div>
                            <br>
                            <div id="value_article"><?= "<em>" . "X" . $article['Quantity'] . "</em>" ?></div>
                            <div id="remove_object"><a href="<?= route("basket/remove_object/basketID=" . $article['BasketID'] . "/value=" . $article['Quantity'] . "/articleID=" . $article['ArticleID']) ?>">
                            <input type="button" class="form-control" value="Supprimer"></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="case case_desc basket">
                        <p><?= $article['Description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div id="container">
        <a href="index.php?action=purchase"><input type="submit" name="insert" id="insert" value="Passer en caisse"></a>
    </div>
<?php } else { ?>
    <h3 style="text-align: center">Vous n'avez pas d'article dans votre panier...</h3><br>
    <div id="container">
        <a href="<?=route('articles/home/')?>"><input type="submit" name="insert" id="insert" value="revenir sur la page d'accueil"></a>
    </div>
<?php } ?>
