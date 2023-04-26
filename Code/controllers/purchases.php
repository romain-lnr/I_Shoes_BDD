<?php
/*
 * Purchases function
 * Do: load purchased articles
 *
*/
function Purchase() {
    require "models/model.php";
    DisplayPurchase();
}

/*
 * AddPurchase Function
 * Do: write in purchase json file
 *
*/
function AddPurchase() {
    require "models/model.php";
    AddPurchaseToJSON();
}

/*
 * Flag Function
 * Do: reorganize the purchase confirmation page
 *
*/
function Flag() {
    require "models/model.php";
    FlagPurchase();
    header("Location:index.php?action=home");
    exit();
}
