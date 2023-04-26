<?php
/*
 * AddPurchaseToJSON Function
 * Do: create an array or arrays to the purchase page
 *
*/
function AddPurchaseToJSON() {

    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    for ($i = 0; $i < $nb_article; $i++) {
        $id_user[$i] = $obj[$i]->username;
        $id_article[$i] = $obj[$i]->id_article;
        $number[$i] = $obj[$i]->number;
        $flag[$i] = false;
    }
    for ($i = 0; $i < $nb_article; $i++) {

        // Load the file
        $JSONfile = 'data/dataPurchases.json';
        $contents = file_get_contents($JSONfile);

        // Decode the JSON data into a PHP array.
        $json = json_decode($contents, true);

        // Write in JSON
        if ($_SESSION['id_user'] == $id_user[$i]) {
            $json[] = array("username" => $id_user[$i], "id_article" => $id_article[$i], "number" => $number[$i], "flag" => $flag[$i]);

            // Encode the array back into a JSON string.
            $encode = json_encode($json, JSON_PRETTY_PRINT);

            // Save the file.
            file_put_contents('data/dataPurchases.json', $encode);

            // Load the file
            $data = file_get_contents('data/dataBasket.json');

            // Decode JSON flow
            $obj = json_decode($data);
            array_splice($obj, $i);
            $json = json_encode($obj, JSON_PRETTY_PRINT);
            file_put_contents('data/dataBasket.json', $json);
        }
    }
    header("Location:index.php?action=purchase_articles");
    exit();
}

/*
 * DisplayPurchase Function
 * Do: load the purchased articles for purchase page
 *
*/
function DisplayPurchase() {

    // Load the file
    $JSONfile = 'data/dataPurchases.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_purchase = count($obj);
    $tab = 0;

    $id_user = $_SESSION['id_user'];

    for ($i = 0; $i < $nb_purchase; $i++) {

        // Load the file
        $JSONfile = 'data/dataPurchases.json';
        $data = file_get_contents($JSONfile);

        // Decode JSON flow
        $obj = json_decode($data);
        $flag[$tab] = $obj[$i]->flag;
        if ($obj[$i]->username == $id_user) {

            $id = $obj[$i]->id_article;
            $number[$tab] = $obj[$i]->number;

            // Load the file
            $JSONfile = 'data/dataArticles.json';
            $data = file_get_contents($JSONfile);

            // DECODE JSON flow
            $obj = json_decode($data);

            // access the appropriate element
            $imgpath_article[$tab] = $obj[$id]->imagepath;
            $name_article[$tab] = $obj[$id]->article;
            $mark_article[$tab] = $obj[$id]->mark;
            $desc_article[$tab] = $obj[$id]->description;
            $price_article[$tab] = $obj[$id]->price;
            $stock_article[$tab] = $obj[$id]->stock;

            $tab++;
        }
    }
    require "views/purchase.php";
}

/*
 * FlagPurchase Function
 * Do: Modify the column flag of dataPurchases to false to true when the user leaves the purchase page
 *
*/
function FlagPurchase()
{

    // Load the file
    $JSONfile = 'data/dataPurchases.json';
    $data = file_get_contents($JSONfile);

    // Decode JSON flow
    $obj = json_decode($data);
    $nb_purchase = count($obj);
    $id_user = $_SESSION['id_user'];

    for ($i = 0; $i < $nb_purchase; $i++) {
        if ($obj[$i]->username == $id_user) {
            $obj[$i]->flag = true;
        }
    }
    // Encode the array back into a JSON string.
    $json = json_encode($obj, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataPurchases.json', $json);
}