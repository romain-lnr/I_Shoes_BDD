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
function UpdateArticlesStockInDatabase($articleId, $newStock) {
    $query = "UPDATE articles SET Stock = '$newStock' WHERE id = '$articleId'";
    executeQueryUpdate($query);
}