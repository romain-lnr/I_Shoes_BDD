<?php
/*
 * AddArticle Function
 * Do: Create or update an article in dataArticles json file
 *
*/
function AddArticle($id_article, $mark, $desc, $price, $stock_number, $imagepath, $filename) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $contents = file_get_contents($JSONfile);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);
    $article = array_search($id_article, array_column( $json, 'article' ) );
    if ($article !== false) {
        $json[$article] = array("article" => $id_article, "mark" => $mark, "description" => $desc, "price" => $price, "stock" => $stock_number, "imagepath" => $imagepath, "image" => $filename);
    }
    else {
        $json[] = array("article" => $id_article, "mark" => $mark, "description" => $desc, "price" => $price, "stock" => $stock_number, "imagepath" => $imagepath, "image" => $filename);
    }

    // Encode the array back into a JSON string.
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataArticles.json', $encode);
}

/*
 * DisplayArticles Function
 * Do: Show articles and update in home and admin page
 *
*/
function DisplayArticles($i) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    if ($i != $nb_article) {

        // access the appropriate element
        $article_specs[] = [$obj[$i]->article, $obj[$i]->mark, $obj[$i]->description, $obj[$i]->price, $obj[$i]->stock, $obj[$i]->imagepath, $obj[$i]->image];
        return $article_specs[0];
    }
    return null;
}

function UpArticles() {
    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    for ($i = 0; $i < $nb_article; $i++) {
        $stock[$i] = $_POST["stock_number_" . strval($i)];
        AddArticle($obj[$i]->article, $obj[$i]->mark, $obj[$i]->description, $obj[$i]->price, $stock[$i], $obj[$i]->imagepath, $obj[$i]->image);
    }
}

/*
 * ShowArticle Function
 * Do: display the requested articles for the user
 *
*/
function ShowArticle($id) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flux
    $obj = json_decode($data);

    $article_specs[] = [$obj[$id]->imagepath, $obj[$id]->article, $obj[$id]->mark, $obj[$id]->description, $obj[$id]->price];
    return $article_specs[0];
}

/*
 * RemoveImgInJSONFunction
 * Do: remove an image in the articles directory
 *
*/
function RemoveImgInJSON($id) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';

    $data = file_get_contents($JSONfile);

    // Decode JSON flow
    $obj = json_decode($data);
    $filename = $obj[$id]->image;
    unlink("media/img/articles/".$filename);
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