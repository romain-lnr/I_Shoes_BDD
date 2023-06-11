<?php

require_once SOURCE_DIR. "/dbconnector.php";

function PutInBasket($username, $articleID, $number)
{
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
        return executeQueryUpdate($updateQuery);
    } else {
// Insérer une nouvelle ligne
        $insertQuery = "INSERT INTO basket (Username, Article_ID, Number) VALUES ('$username', '$articleID', '$number')";
        return executeQueryUpdate($insertQuery);
    }
}

function Display()
{
    $id_user = $_SESSION['id_user'];
    $articlesQuery = "SELECT * FROM basket WHERE Username = '$id_user'";
    $articlesResult = executeQuerySelect($articlesQuery);

    $articleDetails = array(); // Tableau pour stocker les détails des articles

    if (!empty($articlesResult)) {
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
                        'id' => $articleID,
                        'image' => $articleDetailsResult[0]['Imagepath'],
                        'name' => $articleDetailsResult[0]['Name'],
                        'mark' => $articleDetailsResult[0]['Mark'],
                        'description' => $articleDetailsResult[0]['Description'],
                        'price' => $articleDetailsResult[0]['Price'],
                        'quantity' => $number
                    );
                }
            }
        }
    }

    return $articleDetails;
}

