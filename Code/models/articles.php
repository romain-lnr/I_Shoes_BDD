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
function DisplayArticles($exit) {

    // Load the file
    $JSONfile = 'data/dataArticles.json';
    $data = file_get_contents($JSONfile);

    // DECODE JSON flow
    $obj = json_decode($data);
    $nb_article = count($obj);

    // access the appropriate element
    for ($i = 0; $i < $nb_article; $i++) {
        $name_article[$i] = $obj[$i]->article;
        $mark_article[$i] = $obj[$i]->mark;
        $desc_article[$i] = $obj[$i]->description;
        $price_article[$i] = $obj[$i]->price;
        $stock_article[$i] = $obj[$i]->stock;
        $imgpath_article[$i] = $obj[$i]->imagepath;
        $img_article[$i] = $obj[$i]->image;
    }
    switch ($exit) {
        case 'home':
            require "views/home.php";
            break;
        case 'admin':
            require "views/admin.php";
            break;
        case 'update_articles':
            for ($i = 0; $i < $nb_article; $i++) {
                $stock[$i] = $_POST["stock_number_".strval($i)];
                Add_article($name_article[$i], $mark_article[$i], $desc_article[$i], $price_article[$i], $stock[$i], $imgpath_article[$i], $img_article[$i]);
            }
            header("Location:index.php?action=home");
            exit();
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

    // access the appropriate element
    $img_article = $obj[$id]->imagepath;
    $name_article = $obj[$id]->article;
    $mark_article = $obj[$id]->mark;
    $desc_article = $obj[$id]->description;
    $price_article = $obj[$id]->price;
    $stock_article = $obj[$id]->stock;

    require "views/show_article.php";
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
