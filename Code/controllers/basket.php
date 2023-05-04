<?php
/*
 * Add Function
 * Do: update the basket json file by the requested article by user
 *
*/
function Add($id, $value) {

    if (isset($_SESSION['id_user']) && $_SESSION['id_user']) {
        $id_user = $_SESSION['id_user'];
    }
    else {
        header("Location:index.php?error=not_login");
        return;
    }
    require "models/basket.php";
    AddBasket($id_user, $id, $value);
    header("Location:index.php?action=home");
}

/*
 * Basket Function
 * Do: load basket for basket page
 *
*/
function Basket() {
    require "models/basket.php";
    $i = -1;
    $is_article = false;
    $article_good = false;
    do {
        $i++;
        $article_specs[$i] = DisplayBasket($i);
    } while ($article_specs[$i] != null);

    $article_good = array();
        for ($j = 0; $j < $i; $j++) {
            if ($article_specs[$j] != 1) {
                $article_good[$j] = true;
            } else $article_good[$j] = false;
        }

        for ($k = 0; $k < $i; $k++) {
            if ($article_good[$k]) $is_article = true;
        }
    require "views/basket.php";
}


/*
 * RemoveBasket Function
 * Do: remove an article and affect values in basket if the user deletes him
 *
*/
function RemoveBasket($id, $number, $id_article) {
    require "models/basket.php";
    AffectValueInArray($id_article, $number);
    RemoveArrayInJSON($id, 'data/dataBasket.json');
    header("Location:index.php?action=basket");
    exit();
}
