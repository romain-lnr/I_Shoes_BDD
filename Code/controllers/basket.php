<?php
/*
 * Basket Function
 * Do: load basket for basket page
 *
*/
function Basket() {
    require "models/model.php";
    DisplayBasket();
}

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
    require "models/model.php";
    Add_basket($id_user, $id, $value);
}

/*
 * RemoveBasket Function
 * Do: remove an article and affect values in basket if the user deletes him
 *
*/
function RemoveBasket($id, $number, $id_article) {
    require "models/model.php";
    AffectValueInArray($id_article, $number);
    RemoveArrayInJSON($id, 'data/dataBasket.json');
    header("Location:index.php?action=basket");
    exit();
}
