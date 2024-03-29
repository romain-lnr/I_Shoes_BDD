<?php
/**
 * Created by Romain Lenoir.
 * Date: 12.03.2023
 * Desc: show_article page for displays the user request article.
 */

$title = "IShoes - show_article page"; ?>

<?php if (!isset($_SESSION['logged']) || !$_SESSION['logged']) { ?>
    <div class="topnav">
        <a href="<?=route('users/login/')?>"><img src="/images/login.png" height="50"><br>login</a>
        <a href="<?=route('users/login/')?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
    <?php
} else { ?>
    <div class="topnav">
        <a href="<?=route('users/logout/')?>">logout</a>
        <a href="#user" style="height: 10px"><?php echo $_SESSION['id_user'] ?></a>
        <a href="<?=route('users/basket/')?>"><img src="/images/basket.png" height="50"><br>Basket</a>
        <?php if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged']) { ?>
            <a href="<?=route('articles/admin/')?>"><img src="/images/admin.png" height="50"><br>Admin</a>
        <?php } ?>
        <img src="/images/logo.png" height="90">
    </div>
    <br>
    <?php
} ?>
<?php if(isset($bag['data']['article'])):?>
<div id="content">
    <form action="<?=route('articles/create_basket/article='). $bag['articleID']?>" method="POST">
        <div class="row">
            <?php foreach ($bag['data']['article'] as $article) : ?>
            <div class="col-sm-3">
                <div class="case">
                    <div class="image_article_case"><img src="<?= $article['Imagepath'] ?>" class="image_article"></div>
                    <hr>
                    <div class="body_case">
                        <div class="name_article"><?= "<em>" . $article['Name']  . "</em>" ?></div>
                        <div class="brand_article"><?= "<em>" . $article['Brand']  . "</em>" ?></div>
                        <div class="price_article"><?= "<em>" . $article['Price']  . " CHF" . "</em>" ?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="case case_desc">
                    <p><?= $article['Description']  ?></p>
                    <div id="container">
                        <input type="submit" class="form-control" name="insert" id="insert" value="Ajouter au panier">
                        <input type="number" name="value" class="form-control" placeholder="value" required>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </form>
</div>
<?php endif; ?>