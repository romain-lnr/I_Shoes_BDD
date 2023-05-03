<?php
/*
 * Basket Function
 * Do: load basket for basket page
 *
*/
function Basket() {
    require "models/basket.php";
    $i = -1;
    $is_article = false;
    do {
        $i++;
        $article_specs[$i] = DisplayBasket($i);
    } while ($article_specs[$i] != null);

    if (!$i) $is_article = false;
    else $is_article = true;
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
