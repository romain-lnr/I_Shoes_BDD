<?php
/*
* AddBasket Function
* Do: create an array when the user take an article in the basket
*
*/
function AddBasket($id_user, $id_article, $number) {
    // Load the JSON file
    $jsonfile = 'data/dataBasket.json';
    $contents = file_get_contents($jsonfile);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);

    // Check if the user is unique and the article ID is unique for the user
    $boolValue = TestValue($id_article, $number);

    if ($boolValue) {
        // Decrement the stock of the item by the requested number
        AffectValueInArray($id_article, -$number);

        // Search for the user's basket and article ID in the JSON array
        $userBasketIndex = array_search($id_user, array_column($json, 'username'));
        $articleIndex = array_search($id_article, array_column($json, 'id_article'));

        if ($userBasketIndex !== false && $articleIndex !== false) {
            // Update existing basket item with the requested number of items
            $json[$articleIndex]['number'] += $number;
        } else {
            // Create new basket item for the user and article
            $json[] = array("username" => $id_user, "id_article" => $id_article, "number" => $number);
        }
    } else {
        // Redirect to the homepage with an error message
        header("Location:index.php?error=not_even_stock");
        return;
    }

    // Encode the updated array back into a JSON string
    $encodedJson = json_encode($json, JSON_PRETTY_PRINT);

    // Save the updated JSON data to the file.
    file_put_contents($jsonfile, $encodedJson);
}



/*
 * TestValue Function
 * Do: return true or false if the user takes more article value than the stock of article
 *
*/
function TestValue($id, $number) {
    $jsonfile = 'data/dataArticles.json';
    $data = file_get_contents($jsonfile);
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
    $jsonfile = 'data/dataArticles.json';
    $data = file_get_contents($jsonfile);
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
    $jsonfile = 'data/dataBasket.json';
    $data = file_get_contents($jsonfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    if ($i != $nb_article) {
        $id_article = $obj[$i]->id_article;
        $number = $obj[$i]->number;

        if ($obj[$i]->username == $_SESSION['id_user']) {

            // Load the file
            $jsonfile = 'data/dataArticles.json';
            $data = file_get_contents($jsonfile);

            // DECODE JSON flow
            $obj = json_decode($data);
            $article_specs[] = [$id_article, $obj[$id_article]->imagepath, $obj[$id_article]->article, $obj[$id_article]->mark, $obj[$id_article]->description, $obj[$id_article]->price, $number];
            return $article_specs[0];
        }
        return 1;

    }
    return null;
}
