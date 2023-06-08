<?php
require SOURCE_DIR. "/dbconnector.php";
function GetArticles(){
    $articlesQuery = 'SELECT Name, Mark, Imagepath FROM articles';
    return executeQuerySelect($articlesQuery);
}