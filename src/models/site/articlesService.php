<?php
require SOURCE_DIR. "/dbconnector.php";

/*
 * GetArticlesForHome function
 * Do: load articles for home page
 *
*/
function GetArticlesForHome() {
    $articlesQuery = 'SELECT id, Name, Brand, Price, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

/*
 * GetArticlesForAdmin function
 * Do: load articles for admin page
 *
*/
function GetArticlesForAdmin() {
    $articlesQuery = 'SELECT id, Name, Brand, Price, Stock, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

/*
 * ShowArticle function
 * Do: load article for show_article page
 *
*/
function ShowArticle($id) {
    $articlesQuery = "SELECT Name, Brand, Price, Description, Imagepath FROM articles WHERE id='$id';";
    return executeQuerySelect($articlesQuery);
}

/*
 * UpdateArticleStockInDatabase function
 * Do: Update Stock in the articles database
 *
*/
function UpdateArticlesStockInDatabase($id, $newStock):bool {
    $query = "UPDATE articles SET Stock = '$newStock' WHERE id = '$id'";
    return executeQueryUpdate($query);
}

/*
 * Create function
 * Do: Create articles in the database
 *
*/
function Create($name, $mark, $desc, $price, $image):bool {
    $stock = 0;
    $articlesQuery = "INSERT INTO articles (Name, Brand, Description, Price, Stock, Imagepath, Image) VALUES ('$name', '$mark', '$desc', '$price', '$stock', '/images/articles/$image', '$image');";
    return executeQueryInsert($articlesQuery);
}

/*
 * Delete function
 * Do: Delete articles in the database
 *
*/
function Delete($id):bool {

    $imageQuery = "SELECT Image FROM articles WHERE id = '$id'";
    $imageResult = executeQuerySelectSingle($imageQuery);
    $imagepath = 'images/articles/' . $imageResult;
    unlink($imagepath);

   $query = "DELETE FROM articles WHERE id = '$id'";
   return executeQueryUpdate($query);

}