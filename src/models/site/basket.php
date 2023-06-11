<?php

require_once SOURCE_DIR . "/dbconnector.php";

function PutInBasket($username, $articleID, $number)
{
    $basketQuery = "SELECT * FROM basket WHERE Username = '$username'";
    $result = executeQuerySelect($basketQuery);

    $articleQuery = "SELECT Stock FROM articles WHERE id = '$articleID'";
    $articleResult = executeQuerySelectSingle($articleQuery);

    if (!empty($result)) {
        $existingArticleIDs = explode(',', $result[0]['Article_ID']);
        $existingNumbers = explode(',', $result[0]['Number']);

        $index = array_search($articleID, $existingArticleIDs);
        if ($index !== false) {
            $existingNumbers[$index] += $number;
        } else {
            $existingArticleIDs[] = $articleID;
            $existingNumbers[] = $number;
        }

        $newArticleID = implode(',', $existingArticleIDs);
        $newNumber = implode(',', $existingNumbers);

        if ($articleResult >= $number) {
            $removeStock = "UPDATE articles SET Stock = Stock - $number WHERE id = '$articleID'";
            executeQueryUpdate($removeStock);

            $updateQuery = "UPDATE basket SET Number = '$newNumber', Article_ID = '$newArticleID' WHERE Username = '$username'";
            return executeQueryUpdate($updateQuery);
        } else {
            return null; // Stock insuffisant, retourne null
        }
    } else {
        if ($articleResult >= $number) {
            $removeStock = "UPDATE articles SET Stock = Stock - $number WHERE id = '$articleID'";
            executeQueryUpdate($removeStock);

            $insertQuery = "INSERT INTO basket (Username, Article_ID, Number) VALUES ('$username', '$articleID', '$number')";
            return executeQueryUpdate($insertQuery);
        } else {
            return null; // Stock insuffisant, retourne null
        }
    }
}



function Display()
{
    $id_user = $_SESSION['id_user'];
    $articlesQuery = "SELECT * FROM basket WHERE Username = '$id_user'";
    $articlesResult = executeQuerySelect($articlesQuery);
    $articleDetails = array();

    if (!empty($articlesResult)) {
        $basketID = $articlesResult[0]['id'];
        foreach ($articlesResult as $article) {
            $articleIDs = explode(',', $article['Article_ID']);
            $numbers = explode(',', $article['Number']);

            for ($i = 0; $i < count($articleIDs); $i++) {
                $articleID = $articleIDs[$i];
                $number = $numbers[$i];

                // Récupérer les détails de l'article à partir de la table des articles
                $articleDetailsQuery = "SELECT * FROM articles WHERE id = '$articleID'";
                $articleDetailsResult = executeQuerySelect($articleDetailsQuery);

                if (!empty($articleDetailsResult)) {
                    $articleDetails[] = array(
                        'ArticleID' => $articleID,
                        'BasketID' => $basketID,
                        'Image' => $articleDetailsResult[0]['Imagepath'],
                        'Name' => $articleDetailsResult[0]['Name'],
                        'Mark' => $articleDetailsResult[0]['Mark'],
                        'Description' => $articleDetailsResult[0]['Description'],
                        'Price' => $articleDetailsResult[0]['Price'],
                        'Quantity' => $number
                    );
                }
            }
        }
    }

    return $articleDetails;
}

