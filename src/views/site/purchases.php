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
<?php if (isset($bag['data'])): ?>
<h3 style="padding-left: 55px;">Récapitulatif de la commande : </h3>
<div id="content">
    <div class="row">
        <?php foreach ($bag['data'] as $row => $article) : ?>
            <?php if (!$article['Flag']) { ?>
                <div class="col-sm-3">
                    <div class="case basket">
                        <div id="image_article_case"><img src="<?= $article['Imagepath'] ?>" id="image_article"></div>
                        <hr>
                        <div class="body_case">
                            <div id="nom_article"><?= "<em>" . $article['Name'] . "</em>" ?></div>
                            <div id="mark_article"><?= "<em>" . $article['Brand'] . "</em>" ?></div>
                            <div id="price_article"><?= "<em>" . $article['Price'] . " CHF" . "</em>" ?></div>
                            <br>
                            <div id="value_article"><?= "<em>" . "X" . $article['Quantity'] . "</em>" ?></div>
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