<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The basket page for see all purchases of the currently logged user.
 */

$title = "IShoes - basket page"; ?>

<div class="topnav">
    <a href="<?= route('users/logout/') ?>">logout</a>
    <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user'] ?></a>
    <a href="<?= route("articles/home/") ?>"><img src="/images/home.png" height="50"><br>Home</a>
    <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
        <a href="<?= route("articles/admin/") ?>"><img src="/images/admin.png" height="50"><br>Admin</a>
    <?php } ?>
    <img src="/images/logo.png" height="90">
</div>
<br>
<?php
if (!empty($bag['data']['basket'])) { ?>
        <?php foreach ($bag['data']['basket'] as $article) { ?>
            <div id="content">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="case basket">
                            <div class="image_article_case"><img src="<?= $article['Image'] ?>" class="image_article"></div>
                            <hr>
                            <div class="body_case">
                                <div class="name_article"><?= "<em>" . $article['Name'] . "</em>" ?></div>
                                <div class="brand_article"><?= "<em>" . $article['Brand'] . "</em>" ?></div>
                                <div class="price_article"><?= "<em>" . $article['Price'] . " CHF" . "</em>" ?></div>
                                <br>
                                <div class="value_article"><?= "<em>" . "X" . $article['Quantity'] . "</em>" ?></div>
                                <div class="remove_object" style="float: right;"><a
                                            href="<?= route("basket/remove_object/basketID=" . $article['BasketID'] . "/value=" . $article['Quantity'] . "/articleID=" . $article['ArticleID']) ?>">
                                        <span type="button" class="form-control form-remove">Supprimer</span></a></div>
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
            <a href="<?=route('purchases/create_object/')?>"><input type="submit" name="checkout" class="form-control" id="checkout" value="Passer en caisse"></a>
        </div>
<?php } else { ?>
    <h3 style="text-align: center">Vous n'avez pas d'article dans votre panier...</h3><br>
    <div id="container">
        <a href="<?= route('articles/home/') ?>"><input type="submit" name="insert" id="insert" value="revenir sur la page d'accueil"></a>
    </div>
<?php } ?>
