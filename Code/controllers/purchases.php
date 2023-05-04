<?php
/*
 * Purchases function
 * Do: load purchased articles
 *
*/
function Purchase() {
    require "models/purchases.php";
    $i = -1;

    do {
        $i++;
        $article_specs[$i] = DisplayPurchase($i);
    } while ($article_specs[$i] != null);
    require "views/purchase.php";
}

/*
 * AddPurchase Function
 * Do: write in purchase json file
 *
*/
function AddPurchase() {
    require "models/purchases.php";

    LoadBasket();
    header("Location:index.php?action=purchase_articles");
}

/*
 * Flag Function
 * Do: reorganize the purchase confirmation page
 *
*/
function Flag() {
    require "models/purchases.php";
    FlagPurchase();
    header("Location:index.php?action=home");
    exit();
}
