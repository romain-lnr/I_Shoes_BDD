<?php
require_once SOURCE_DIR. "/dbconnector.php";

/*
 * Create function
 * Do: Create iterations in the purchases table
 *
*/
function Create($username) {

    $basketQuery = "SELECT Article_ID, Number FROM basket WHERE Username = '$username'";
    $basketResult = executeQuerySelect($basketQuery);

    if (!empty($basketResult)) {
        $articleIDs = explode(',', $basketResult[0]['Article_ID']);
        $numbers = explode(',', $basketResult[0]['Number']);

        // Insérer chaque article dans la table purchases
        foreach ($articleIDs as $index => $articleID) {
            $quantity = $numbers[$index];

            // Insérer l'article dans la table purchases
            $insertQuery = "INSERT INTO purchases (Username, Article_ID, Number, Flag) VALUES ('$username', $articleID, $quantity, false)";
            executeQueryInsert($insertQuery);
        }

        // Supprimer toutes les données du panier de l'utilisateur
        $deleteQuery = "DELETE FROM basket WHERE Username = '$username'";
        executeQueryUpdate($deleteQuery);

    }
}

/*
 * Display function
 * Do: load articles for purchases page
 *
*/
function Display($username):array {
    $purchasesQuery = "SELECT Article_ID, Number, Flag FROM purchases WHERE Flag = 0 AND Username = '$username'";
    $purchasesResult = executeQuerySelect($purchasesQuery);

    $articles = array();
    foreach ($purchasesResult as $purchase) {
        $articleID = $purchase['Article_ID'];
        $number = $purchase['Number'];
        $flag = $purchase['Flag'];

        $selectQuery = "SELECT * FROM articles WHERE id = '$articleID'";
        $resultQuery = executeQuerySelect($selectQuery);

        if (!empty($resultQuery)) {
            $articleInfo = array(
                'Imagepath' => $resultQuery[0]['Imagepath'],
                'Name' => $resultQuery[0]['Name'],
                'Price' => $resultQuery[0]['Price'],
                'Brand' => $resultQuery[0]['Brand'],
                'Quantity' => $number,
                'Flag' => $flag
            );
            $articles[] = $articleInfo;
        }
    }

    return $articles;
}

/*
 * Refresh function
 * Do: Refresh Flag to 0 from 1 for purchases page
 *
*/
function Refresh($username) {
    $purchasesQuery = "SELECT id FROM purchases WHERE Flag = 0 AND Username = '$username'";
    $purchasesResult = executeQuerySelect($purchasesQuery);

    foreach ($purchasesResult as $purchases) {
        $purchasesID = $purchases['id'];

        $flag_replaceQuery = "UPDATE purchases SET Flag = true WHERE id = '$purchasesID'";
        executeQueryUpdate($flag_replaceQuery);
    }
}

function ShowHistoric() {
    $purchasesQuery = 'SELECT Username, Article_ID, Number FROM purchases';
    return executeQuerySelect($purchasesQuery);
}



