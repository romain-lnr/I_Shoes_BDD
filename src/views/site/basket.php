<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The basket page for see all purchases of the currently logged user.
 */

// tampon de flux stocké en mémoire
$title="IShoes - basket page"
?>
    <div class="topnav">
        <a href="index.php?action=logout">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="index.php?action=home"><img src="/images/home.png" height="50"><br>Home</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="index.php?action=admin"><img src="/images/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
    <?php if ($is_article) { ?>
        <?php for ($m = 0; $m < $i; $m++) { ?>
            <?php if ($article_good[$m]) { ?>
            <div id="content">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="case basket">
                            <div id="image_article_case"><img src="<?=$article_specs[$m][1]?>" id="image_article"></div>
                            <hr>
                            <div class="body_case">
                                <div id="nom_article"><?="<em>".$article_specs[$m][2]."</em>"?></div>
                                <div id="mark_article"><?="<em>".$article_specs[$m][3]."</em>"?></div>
                                <div id="price_article"><?="<em>".$article_specs[$m][5]." CHF"."</em>"?></div>
                                <br>
                                <div id="value_article"><?="<em>"."X".$article_specs[$m][6]."</em>"?></div>
                                <div id="remove_object"><a href="index.php?receive_basket=<?=$m?>&value=<?=$article_specs[$m][6]?>&id_article=<?=$article_specs[$m][0]?>"><input type="button" class="form-control" value="Supprimer"></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="case case_desc basket">
                            <p><?=$article_specs[$m][4]?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        <?php } ?>
        <div id="container">
            <a href="index.php?action=purchase"><input type="submit" name="insert" id="insert" value="Passer en caisse"></a>
        </div>
    <?php } else { ?>
        <h3 style="text-align: center">Vous n'avez pas d'article dans votre panier...</h3><br>
    <div id="container">
        <a href="index.php?action=home"><input type="submit" name="insert" id="insert" value="revenir sur la page d'accueil"></a>
    </div>
    <?php } ?>
        <br>
          <footer>
        <div id="contrainer">
            <div class="row">
                <div class="col-sm-3">
                    <div id="footer_proj">
                        <h3>Notre projet</h3>
                        <p>Notre projet se base sur un site e-commerce de vente de chaussures. L'équipe est composé d'un web master, d'un responsable développeur et de quelqu'un servant à la création de maquettes et des élements ments basiques du projet.
                            Le projet a été publié le 6 avril 2023 et a commencé quelques mois auparavant.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="footer_desc">
                        <h3>Descriptif du projet</h3>
                        <p>Ce projet est, comme dit, un avant-goût d'un site e-commerce où le concept est la vente de chaussures. Vous trouverez ici nos articles les plus fameux ainsi que les derniers ajouts de nos services.
                            Comme par exemple le principe de pouvoir se logger en tant qu'utilisateur du site, de pouvoir y regarder ces différents articles et de pouvoir ajouter un article sur votre panier d'achat afin de le payer. Vous pouvez ainsi profiter des dernières actualités en cours.
                            Le projet a également l'éloge d'avoir un compte administrateur afin que vous pouviez quotidiennement avoir de nouveaux stocks sur vos articles préférés
                        </p>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="footer_contact">
                        <h3>Contact du service</h3>
                        <h6>Téléphone :</h6>
                        <p>+41 67 827 65 24</p>
                        <h6>Email :</h6>
                        <p><a href="mailto:i_shoes.contact@gmail.com">i_shoes.contact@gmail.com</a></p>
                        <h6>Adresse :</h6>
                        <p>Rue de la Réunion 14<br>1450 Ste-Croix, Vaud Suisse</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>