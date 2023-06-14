<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: TDC_admin page for create an article -- ONLY for admin
 */

$title="IShoes - TDC_admin page"; ?>
<div id="container">
    <form action="<?=route('articles/create_article/')?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <h1>Table de création</h1>
            <label for="id_article"><b>Nom d'article</b></label>
            <input type="text" class="form-control" placeholder="Entrer le nom de l'article" name="name" maxlength="50" required>
            <label for="mark"><b>Nom de la marque</b></label>
            <input type="text" class="form-control" placeholder="Entrer le nom de la marque de l'article" name="mark" maxlength="20" required>
            <label for="desc"><b>Description</b></label>
            <input type="text" class="form-control" placeholder="Entrer une sobre description de l'article" name="desc" maxlength="500" required>
            <label for="price"><b>Prix</b></label>
            <input type="number" class="form-control" placeholder="Entrer le prix à établir" name="price" maxlength="6" required>
            <label for="img_article"><b>Image de l'article</b></label>
            <input type="file" class="form-control" placeholder="Entrer une image pour l'article" name="image" required>
            <input type="submit" class="form-control" name="insert" value='AJOUTER' >

            <?php
            if(isset($bag['data']['error'])){
                $error = $bag['data']['error'];
                if($error == "ImgNotGood") echo "<p style='color:red'>Erreur : Votre extension de fichier cible n'est pas appropriée</p>";
            }
            ?>
        </div>
    </form>
</div>
