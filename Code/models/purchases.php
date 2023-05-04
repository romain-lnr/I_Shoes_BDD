<?php
function LoadBasket()
{

    // Load the file
    $jsonfile = 'data/dataBasket.json';
    $data = file_get_contents($jsonfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    for ($i = 0; $i < $nb_article; $i++) {
        $id_user[$i] = $obj[$i]->username;
        $id_article[$i] = $obj[$i]->id_article;
        $number[$i] = $obj[$i]->number;
        $flag[$i] = false;
    }
    for ($j = 0; $j < $i; $j++) {
        AddPurchaseToJSON($id_user[$j], $id_article[$j], $number[$j], $flag[$j]);
    }
}

/*
 * AddPurchaseToJSON Function
 * Do: create an array or arrays to the purchase page
 *
*/
function AddPurchaseToJSON($id_user, $id_article, $number, $flag)
{

    // Load the file
    $jsonfile = 'data/dataPurchases.json';
    $contents = file_get_contents($jsonfile);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);

    // Write in JSON
    if ($_SESSION['id_user'] == $id_user) {
        $json[] = array("username" => $id_user, "id_article" => $id_article, "number" => $number, "flag" => $flag);

        // Encode the array back into a JSON string.
        $encode = json_encode($json, JSON_PRETTY_PRINT);

        // Save the file.
        file_put_contents('data/dataPurchases.json', $encode);

        // Load the file
        $data = file_get_contents('data/dataBasket.json');

        // Decode JSON flow
        $obj = json_decode($data);

        // Remove the object from the array using splice.
        array_splice($obj, 0, 1);

        $json = json_encode($obj, JSON_PRETTY_PRINT);
        file_put_contents('data/dataBasket.json', $json);
        return false;
    }
    return true;
}

/*
 * DisplayPurchase Function
 * Do: load the purchased articles for purchase page
 *
*/
function DisplayPurchase($i)
{

    // Load the file
    $jsonfile = 'data/dataPurchases.json';
    $data = file_get_contents($jsonfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_purchase = count($obj);

    if ($i != $nb_purchase) {
        $id_user = $_SESSION['id_user'];

        // Load the file
        $jsonfile = 'data/dataPurchases.json';
        $data = file_get_contents($jsonfile);

        // Decode JSON flow
        $obj = json_decode($data);
        $flag[$i] = $obj[$i]->flag;
        if ($obj[$i]->username == $id_user) {

            $id = $obj[$i]->id_article;
            $number[$i] = $obj[$i]->number;
            // Load the file
            $jsonfile = 'data/dataArticles.json';
            $data = file_get_contents($jsonfile);

            // DECODE JSON flow
            $obj = json_decode($data);
            $article_specs[] = [$obj[$id]->imagepath, $obj[$id]->article, $obj[$id]->mark, $obj[$id]->price, $number[$i], $flag[$i]];
            return $article_specs[0];
        }
    }
    return null;
}

/*
 * FlagPurchase Function
 * Do: Modify the column flag of dataPurchases to false to true when the user leaves the purchase page
 *
*/
function FlagPurchase()
{

    // Load the file
    $jsonfile = 'data/dataPurchases.json';
    $data = file_get_contents($jsonfile);

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