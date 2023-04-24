<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The admin page for inventory management and article creation.
 */

// tampon de flux stocké en mémoire
$title="IShoes - admin page";
ob_start();?>
    <div class="topnav">
        <a href="index.php?action=logout">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="index.php?action=TDC"><img src="../media/img/TDC_admin.png" height="50"><br>TDC</a>
        <a href="index.php?action=historic"><img src="../media/img/historique.png" height="50"><br>Historic</a>
        <a href="index.php?action=home"><img src="../media/img/home.png" height="50"><br>Home</a>
        <ion-icon name="stats-chart-outline"></ion-icon>

        <img src="../media/img/logo.png" height="90">
    </div>
<?php $topnav = ob_get_clean(); ?>
    <br>
    <?php ob_start(); ?>
    <form action="index.php?action=update_articles" method="POST">
        <div id="content">
            <div class="row">
                <?php for ($i = 0; $i < $nb_article; $i++) { ?>
                    <?php $stock_number[$i] = "stock_number_".strval($i);
                    $button[$i] = "button_".strval($i);
                    $number[$i] = "number_".strval($i);?>
                    <div class="col-sm-3">
                        <div class="case case_admin">
                            <div id="image_article_case"><img src="<?=$imgpath_article[$i]?>" id="image_article"></div>
                            <hr>
                            <div class="body_case">
                                <div id="nom_article"><?="<em>".$name_article[$i]."</em>"?></div>
                                <div id="mark_article"><?="<em>".$mark_article[$i]."</em>"?></div>
                                <div id="price_article"><?="<em>".$price_article[$i]." CHF"."</em>"?></div><br><br>
                                <div class="stock"><h3>Stock : </h3><input name="<?=$stock_number[$i]?>" type="number" class="form-control" value="<?=$stock_article[$i]?>" style="background-color: #8F8F8F;" id="<?=$stock_number[$i]?>" readonly></div>
                                <input type="number" class="form-control" id="<?=$number[$i]?>">
                                <div id="submit_case"><input type="button" class="btn btn-info" onclick="document.querySelector('#<?=$stock_number[$i]?>').value = document.querySelector('#<?=$number[$i]?>').value" id=<?=$button[$i]?> value="Submit"></div>
                                <div id="remove_object" style="float: right;"><a href="index.php?receive_admin=<?=$i?>"><input type="button" class="form-control" value="Supprimer"></a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <br>
        <div id="container">
            <input type="submit" name="insert" id="insert" value="Mettre à jour">
        </div>
    </form>
<?php $content = ob_get_clean(); ?>
<?php ob_start(); ?>
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
<?php $footer = ob_get_clean();
require "layout.php";
