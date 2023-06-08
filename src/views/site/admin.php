<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The admin page for inventory management and article creation.
 */

// tampon de flux stocké en mémoire
$title="IShoes - admin page"; ?>
    <div class="topnav">
        <a href="index.php?action=logout">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="index.php?action=TDC"><img src="../media/img/TDC_admin.png" height="50"><br>TDC</a>
        <a href="index.php?action=historic"><img src="../media/img/historique.png" height="50"><br>Historic</a>
        <a href="index.php?action=home"><img src="../media/img/home.png" height="50"><br>Home</a>
        <ion-icon name="stats-chart-outline"></ion-icon>

        <img src="../media/img/logo.png" height="90">
    </div>
    <br>
    <form action="index.php?action=update_articles" method="POST">
        <div id="content">
            <div class="row">
                <?php for ($j = 0; $j < $i; $j++) { ?>
                    <?php $stock_number[$j] = "stock_number_".strval($j);
                    $button[$j] = "button_".strval($j);
                    $number[$j] = "number_".strval($j);?>
                    <div class="col-sm-3">
                        <div class="case case_admin">
                            <div id="image_article_case"><img src="<?=$article_specs[$j][5]?>" id="image_article"></div>
                            <hr>
                            <div class="body_case">
                                <div id="nom_article"><?="<em>".$article_specs[$j][0]."</em>"?></div>
                                <div id="mark_article"><?="<em>".$article_specs[$j][1]."</em>"?></div>
                                <div id="price_article"><?="<em>".$article_specs[$j][3]." CHF"."</em>"?></div><br><br>
                                <div class="stock"><h3>Stock : </h3><input name="<?=$stock_number[$j]?>" type="number" class="form-control" value="<?=$article_specs[$j][4]?>" style="background-color: #8F8F8F;" id="<?=$stock_number[$j]?>" readonly></div>
                                <input type="number" class="form-control" id="<?=$number[$j]?>">
                                <div id="submit_case"><input type="button" class="btn btn-info" onclick="document.querySelector('#<?=$stock_number[$j]?>').value = document.querySelector('#<?=$number[$j]?>').value" id=<?=$button[$j]?> value="Submit"></div>
                                <div id="remove_object" style="float: right;"><a href="index.php?receive_admin=<?=$j?>"><input type="button" class="form-control" value="Supprimer"></a></div>
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
