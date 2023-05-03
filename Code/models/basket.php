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

    $boolValue = TestValue($id, $number);

    if ($boolValue) {

        // Affect the value
        AffectValueInArray($id, -$number);

        // Write in JSON
        $user_basket[0] = array_search($id_user, array_column($json, 'username'));
        $id_basket[0] = array_search($id, array_column($json, 'id_article'));

        if ($user_basket[0] !== false && $id_basket[0] !== false) {
            $json[$id_basket] = array("username" => $id_user, "id_article" => $id, "number" => $_SESSION['value'][$id] + $number);
            $_SESSION['value'][$id] += $number;
        } else {
            $json[] = array("username" => $id_user, "id_article" => $id, "number" => $number);
            $_SESSION['value'][$id] = $number;
        }
    } else {
        // Change error
        header("Location:index.php?error=not_even_stock");
        return;
    }

    // Encode the array back into a JSON string
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataBasket.json', $encode);
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
 * RemoveArrayInJSON Function
 * Do: remove a line in a json file
 *
*/
function RemoveArrayInJSON($id, $path) {

    // Load the file
    $data = file_get_contents($path);

    // Decode JSON flow
    $obj = json_decode($data);
    array_splice($obj, $id, 1);
    $json = json_encode($obj, JSON_PRETTY_PRINT);
    file_put_contents($path, $json);
}

/*
 * DisplayBasket Function
 * Do: load the basket for basket page
 *
*/
function DisplayBasket($i) {

    // Load the file
    $JSONfile = 'data/dataBasket.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    if ($i != $nb_article) {
        $id_article = $obj[$i]->id_article;
        $number = $obj[$i]->number;

        if ($obj[$i]->username == $_SESSION['id_user']) {

            // Load the file
            $JSONfile = 'data/dataArticles.json';
            $data = file_get_contents($JSONfile);

            // DECODE JSON flow
            $obj = json_decode($data);
            $article_specs[] = [$id_article, $obj[$id_article]->imagepath, $obj[$id_article]->article, $obj[$id_article]->mark, $obj[$id_article]->description, $obj[$id_article]->price, $number];
            return $article_specs[0];
        }
    }
    return null;
}
