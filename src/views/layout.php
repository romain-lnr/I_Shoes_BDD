<?php /**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: layout page for the template of page on the website.
 */ ?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/style.css" media="screen" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body id="snow">
<?= $content ?>
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
</body>
</html>