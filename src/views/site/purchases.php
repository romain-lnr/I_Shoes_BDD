<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The purchase page for purchases
 */

$title = "IShoes - purchase page"; ?>
<div class="topnav">
    <img src="/images/logo.png" height="90">
</div>
<br>
<div id="thanks">
    <h2>Merci pour votre achat !</h2>
    <h3>Votre commande va bientôt être expédiée</h3><br>
</div>
<?php if (isset($bag['data']['article'])): ?>
<h3 style="padding-left: 55px;">Récapitulatif de la commande : </h3>
<div id="content">
    <div class="row">
        <?php foreach ($bag['data']['article'] as $article) : ?>
            <?php if (!$article['Flag']) { ?>
                <div class="col-sm-3">
                    <div class="case basket">
                        <div class="image_article_case"><img src="<?= $article['Imagepath'] ?>" id="image_article"></div>
                        <hr>
                        <div class="body_case">
                            <div class="nom_article"><?= "<em>" . $article['Name'] . "</em>" ?></div>
                            <div class="mark_article"><?= "<em>" . $article['Brand'] . "</em>" ?></div>
                            <div class="price_article"><?= "<em>" . $article['Price'] . " CHF" . "</em>" ?></div>
                            <br>
                            <div class="value_article"><?= "<em>" . "X" . $article['Quantity'] . "</em>" ?></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div id="container">
    <a href="<?= route('purchases/flag_refresh/') ?>"><input type="submit" name="insert" id="insert"
                                                            value="Revenir sur la page d'accueil"></a>
</div>