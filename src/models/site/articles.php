<?php
require SOURCE_DIR. "/dbconnector.php";

function GetArticlesForHome(){
    $articlesQuery = 'SELECT id, Name, Mark, Price, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);
}

function GetArticlesForAdmin(){
    $articlesQuery = 'SELECT id, Name, Mark, Price, Stock, Imagepath FROM articles;';
    return executeQuerySelect($articlesQuery);


}

function ShowArticle($id) {
    $articlesQuery = "SELECT Name, Mark, Price, Description, Imagepath FROM articles WHERE id='$id';";
    return executeQuerySelect($articlesQuery);
}

function PutInBasket($username, $articleID, $number) {
    // Vérifier si une ligne correspondante existe déjà dans la table basket
    $selectQuery = "SELECT * FROM basket WHERE Username = '$username'";
    $result = executeQuerySelect($selectQuery);

    if (!empty($result)) {
        // Mettre à jour la ligne existante
        $existingArticleIDs = explode(',', $result[0]['Article_ID']);
        $existingNumbers = explode(',', $result[0]['Number']);

        $index = array_search($articleID, $existingArticleIDs);
        if ($index !== false) {
            // L'article existe déjà, mettre à jour le nombre correspondant
            $existingNumbers[$index] += $number;
        } else {
            // Ajouter un nouvel article et son nombre
            $existingArticleIDs[] = $articleID;
            $existingNumbers[] = $number;
        }

        $newArticleID = implode(',', $existingArticleIDs);
        $newNumber = implode(',', $existingNumbers);

        $updateQuery = "UPDATE basket SET Number = '$newNumber', Article_ID = '$newArticleID' WHERE Username = '$username'";
        executeQueryUpdate($updateQuery);
    } else {
        // Insérer une nouvelle ligne
        $insertQuery = "INSERT INTO basket (Username, Article_ID, Number) VALUES ('$username', '$articleID', '$number')";
        executeQueryUpdate($insertQuery);
    }
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

    $imageQuery = "SELECT Image FROM articles WHERE id = '$id'";
    $imageResult = executeQuerySelectSingle($imageQuery);
    $imagepath = 'images/articles/' . $imageResult;
    unlink($imagepath);

   $query = "DELETE FROM articles WHERE id = '$id'";
   executeQueryUpdate($query);

}