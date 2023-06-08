<?php
require SOURCE_DIR. "/dbconnector.php";

function GetArticlesForHome(){
    $articlesQuery = 'SELECT Name, Mark, Price, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

function GetArticlesForAdmin(){
    $articlesQuery = 'SELECT Name, Mark, Price, Stock, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

function UpdateArticlesStockInDatabase($articleId, $newStock) {
    $query = "UPDATE articles SET Stock = '$newStock' WHERE id = '$articleId'";
    executeQueryUpdate($query);
}