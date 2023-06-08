<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The purchase page for purchases
 */

// tampon de flux stocké en mémoire
$title="IShoes - purchase page";
ob_start(); ?>
<div class="topnav">
    <img src="../media/img/logo.png" height="90">
</div>
<br>
<?php $topnav = ob_get_clean();
ob_start(); ?>
<div id="thanks">
    <h2>Merci pour votre achat !</h2>
    <h3>Votre commande va bientôt être expédiée</h3><br>
</div>
<h3 style="padding-left: 55px;">Récapitulatif de la commande : </h3>
    <div id="content">
        <div class="row">
            <?php for ($j = 0; $j < $i; $j++) {
                if (!$article_specs[$j][5]) {?>
                    <div class="col-sm-3">
                        <div class="case basket">
                            <div id="image_article_case"><img src="<?=$article_specs[$j][0]?>" id="image_article"></div>
                            <hr>
                            <div class="body_case">
                                <div id="nom_article"><?="<em>".$article_specs[$j][1]."</em>"?></div>
                                <div id="mark_article"><?="<em>".$article_specs[$j][2]."</em>"?></div>
                                <div id="price_article"><?="<em>".$article_specs[$j][3]." CHF"."</em>"?></div>
                                <br>
                                <div id="value_article"><?="<em>"."X".$article_specs[$j][4]."</em>"?></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<div id="container">
    <a href="index.php?action=flag_refresh"><input type="submit" name="insert" id="insert" value="Revenir sur la page d'accueil"></a>
</div>
<?php $content = ob_get_clean();
ob_start(); ?>