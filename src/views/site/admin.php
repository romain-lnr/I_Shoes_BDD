<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: The admin page for inventory management and article creation.
 */

$title="IShoes - admin page"; ?>
    <div class="topnav">
        <a href="<?=route("users/logout/")?>">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="<?=route("users/TDC/")?>"><img src="/images/TDC_admin.png" height="50"><br>TDC</a>
        <a href="index.php?action=historic"><img src="/images/historique.png" height="50"><br>Historic</a>
        <a href="<?=route('articles/home/')?>"> <img src="/images/home.png" height="50"><br>Home</a>

        <img src="/images/logo.png" height="90">
    </div>
    <br>
<?php if(isset($bag['data'])):?>
    <form action="<?=route('articles/stock_review/')?>" method="POST">
        <div id="content">
            <div class="row">
                <?php foreach ($bag['data'] as $row => $article) : ?>
                <?php $row++; ?>
                    <?php $stock_number[$row] = "stock_number_".strval($article['id']);
                    $button[$row] = "button_".strval($article['id']);
                    $number[$row] = "number_".strval($article['id']);?>
                    <div class="col-sm-3">
                        <div class="case case_admin">
                            <div id="image_article_case"><img src="<?=$article['Imagepath'];?>" id="image_article"></div>
                            <hr>
                            <div class="body_case">
                                <div id="nom_article"><?="<em>".$article['Name']."</em>";?></div>
                                <div id="mark_article"><?="<em>".$article['Mark']."</em>";?></div>
                                <div id="price_article"><?="<em>".$article['Price']." CHF"."</em>";?></div><br><br>
                                <div class="stock"><h3>Stock : </h3><input name="<?=$stock_number[$row]?>" type="number" class="form-control" value="<?=$article['Stock'];?>" style="background-color: #8F8F8F;" id="<?=$stock_number[$row]?>" readonly></div>
                                <input type="number" class="form-control" id="<?=$number[$row]?>">
                                <div id="submit_case"><input type="button" class="btn btn-info" onclick="document.querySelector('#<?=$stock_number[$row]?>').value = document.querySelector('#<?=$number[$row]?>').value" id=<?=$button[$row]?> value="Submit"></div>
                                <div id="remove_object" style="float: right;"><a href="<?=route("articles/delete/article="). $article['id']?>"><input type="button" class="form-control" value="Supprimer"></a></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <div id="container">
            <input type="submit" name="insert" id="insert" value="Mettre à jour">
        </div>
    </form>
<?php endif; ?>
