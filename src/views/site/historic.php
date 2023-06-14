<?php
/**
 * Created by Romain Lenoir.
 * Date: 15.03.2023
 * Desc: historic page for show the historic of users -- ONLY for admin
 */

$title="IShoes - historic page"; ?>
    <div class="topnav">
        <a href="<?=route('users/logout/')?>">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user']?></a>
        <a href="<?=route('users/basket/')?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="<?=route('articles/admin/')?>"><img src="/images/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
<?php
if (isset($bag['data'])):
    foreach ($bag['data'] as $article) :
        echo "<h1>"."L'utilisateur { ". $article['Username']. " } a acheté l'article numéro ". $article['Article_ID']. ", ". $article['Number']. " fois.". "</h1>";
       endforeach;
       endif;