<?php
/*
* AddBasket Function
* Do: create an array when the user take an article in the basket
*
*/
function AddBasket($id_user, $id, $number) {
    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $contents = file_get_contents($JSONfile);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);

    $boolValue = Test_value($id, $number);

    if ($boolValue) {

        // Affect the value
        AffectValueInArray($id, -$number);

        // Write in JSON
        $user_basket = array_search($id_user, array_column($json, 'username'));
        $id_basket = array_search($id, array_column($json, 'id_article'));

        if ($user_basket !== false && $id_basket !== false) {
            $json[$id_basket] = array("username" => $id_user, "id_article" => $id, "number" => $_SESSION['value'][$id] + $number);
            $_SESSION['value'][$id] += $number;
        } else {
            $json[] = array("username" => $id_user, "id_article" => $id, "number" => $number);
            $_SESSION['value'][$id] = $number;
        }
    } else {
        header("Location:index.php?error=not_even_stock");
        return;
    }

    // Encode the array back into a JSON string
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataBasket.json', $encode);
    header("Location:index.php?action=home");
    exit();
}

/*
 * TestValue Function
 * Do: return true or false if the user takes more article value than the stock of article
 *
*/
function TestValue($id, $number) {
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);
    $obj = json_decode($data);

    if ($obj[$id]->stock >= $number && $number >= 1) return true;
    else return false;
}

/*
 * AffectValueInArray Function
 * Do: add values in dataArticles json file
 *
*/
function AffectValueInArray($id, $number) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);
    $obj = json_decode($data);

    $obj[$id]->stock += $number;

    // Encode the array back into a JSON string
    $encode = json_encode($obj, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataArticles.json', $encode);
}

/*
 * DisplayBasket Function
 * Do: load the basket for basket page
 *
*/
function DisplayBasket() {

    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);
    $tab = 0;
    $isArticle = false;

    // access the appropriate element
    for ($i = 0; $i < $nb_article; $i++) {

        // Load the file
        $JSONfile = 'data/dataBasket.json';
        $data = file_get_contents($JSONfile);

        // DECODE JSON flow
        $obj = json_decode($data);

        if ($obj[$i]->username == $_SESSION['id_user']) {
            $id[$i] = $obj[$i]->id_article;
            $number[$tab] = $obj[$i]->number;

            // Load the file
            $JSONfile = 'data/dataArticles.json';
            $data = file_get_contents($JSONfile);

            // DECODE JSON flow
            $obj = json_decode($data);

            // access the appropriate element
            $img_article[$tab] = $obj[$id[$i]]->imagepath;
            $name_article[$tab] = $obj[$id[$i]]->article;
            $mark_article[$tab] = $obj[$id[$i]]->mark;
            $desc_article[$tab] = $obj[$id[$i]]->description;
            $price_article[$tab] = $obj[$id[$i]]->price;
            $stock_article[$tab] = $obj[$id[$i]]->stock;

            $tab++;

            if (!$isArticle) $isArticle = true;
        }
    }
    require "views/basket.php";
}
