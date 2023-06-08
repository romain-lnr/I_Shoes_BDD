<?php
require SOURCE_DIR. "/dbconnector.php";
function GetArticles(){
    $articlesQuery = 'SELECT Name, Mark, Image FROM articles';
    return executeQuerySelect($articlesQuery);
}