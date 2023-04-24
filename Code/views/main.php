<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: main page for displays slider and welcome the user.
 */

// tampon de flux stocké en mémoire
$title="IShoes - main page";
ob_start();
?>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<div class="topnav">
        <a href="index.php?action=login"><img src="../media/img/login.png" height="50"><br>login</a>
        <a href="index.php?error=not_login"><img src="../media/img/basket.png" height="50"><br>Basket</a>
        <a href="index.php?action=home" id="logo"><img src="../media/img/logo.png" height="90"></a>
    </div>
    <?php $topnav = ob_get_clean();
    ob_start();?>
        <br><br>
        <div class="w3-container w3-center w3-animate-zoom">
            <div class="slideshow-container">

                <div class="mySlides fadeSlide">
                    <div class="numbertext">1 / 3</div>
                    <img src="../media/img/articles/Air%20Jordan%20Dior.png" style="width:100%" height="700">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fadeSlide">
                    <div class="numbertext">2 / 3</div>
                    <img src="../media/img/articles/Air%20jordan%204%20off%20white.png" style="width:100%" height="700">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fadeSlide">
                    <div class="numbertext">3 / 3</div>
                    <img src="../media/img/articles/Air%20Jordan%20REtro%20High%20TravisScott%20CactusJack.png" style="width:100%" height="700">
                    <div class="text">Caption Three</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>
            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>
        </div>
    <?php $content = ob_get_clean();
    ob_start();?>
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
    <script src="../media/scripts/slider.js">
    </script>
<?php $footer = ob_get_clean();
require "layout.php"; ?>