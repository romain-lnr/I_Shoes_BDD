<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: show_article page for displays the user request article.
 */

// tampon de flux stocké en mémoire
$title="IShoes - show_article page";
$article_specs = $data['article'];
?>
    <div id="content">
        <form action="index.php?receive_show_article=<?=strval($id)?>" method="POST">
            <div class="row">
                <div class="col-sm-3">
                    <div class="case">
                        <div id="image_article_case"><img src="<?=$article_specs[0]?>" id="image_article"></div>
                        <hr>
                        <div class="body_case">
                            <div id="nom_article"><?="<em>".$article_specs[1]."</em>"?></div>
                            <div id="mark_article"><?="<em>".$article_specs[2]."</em>"?></div>
                            <div id="price_article"><?="<em>".$article_specs[4]." CHF"."</em>"?></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="case case_desc">
                        <p><?=$article_specs[3]?></p>
                        <div id="container">
                            <input type="submit" class="form-control" name="insert" id="insert" value="Ajouter au panier">
                            <input type="number" name="value" class="form-control" placeholder="value">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
