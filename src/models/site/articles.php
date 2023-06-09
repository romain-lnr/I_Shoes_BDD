<?php
require SOURCE_DIR. "/dbconnector.php";

function GetArticlesForHome(){
    $articlesQuery = 'SELECT id, Name, Mark, Price, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

function GetArticlesForAdmin(){
    $articlesQuery = 'SELECT Name, Mark, Price, Stock, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

function ShowArticle($id) {
    $articlesQuery = "SELECT Name, Mark, Price, Description, Imagepath FROM articles WHERE id='$id';";
    return executeQuerySelect($articlesQuery);
}

function PutInBasket($id, $value) {
    $id_user = $_SESSION['id_user'];
    $articlesQuery = "INSERT INTO basket (Username, Article_ID, Number) VALUES ('$id_user', '$id', '$value');";
    executeQueryInsert($articlesQuery);
}

function UpdateArticlesStockInDatabase($id, $newStock) {
    $query = "UPDATE articles SET Stock = '$newStock' WHERE id = '$id'";
    executeQueryUpdate($query);
}

function Create($name, $mark, $desc, $price, $image) {
    $stock = 0;
    $articlesQuery = "INSERT INTO articles (Name, Mark, Description, Price, Stock, Imagepath, Image) VALUES ('$name', '$mark', '$desc', '$price', '$stock', '/images/articles/$image', '$image');";
    executeQueryInsert($articlesQuery);
}

function Delete($id) {
    $query = "DELETE FROM articles WHERE id = '$id'";
    executeQueryUpdate($query);

    $imageQuery = "SELECT Image FROM articles WHERE id = '$id'";
    $imageResult = executeQuerySelectSingle($imageQuery);
    $imagePath = '../../../public/images/articles/' . $imageResult['Image'];
        unlink('../../../public/images/articles/' . $imageResult['Image']);
}