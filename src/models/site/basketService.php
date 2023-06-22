<?php

require_once SOURCE_DIR . "/dbconnector.php";

/*
 * PutInBasket function
 * Do: Create iterations in the basket table
 *
*/
function PutInBasket($username, $articleID, $number):bool
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

        if ($articleResult >= $number && $number > 0) {
            $removeStock = "UPDATE articles SET Stock = Stock - $number WHERE id = '$articleID'";
            executeQueryUpdate($removeStock);

            $updateQuery = "UPDATE basket SET Number = '$newNumber', Article_ID = '$newArticleID' WHERE Username = '$username'";
            executeQueryUpdate($updateQuery);
            return true;
        } else {
            return false;
        }
    } else {
        if ($articleResult >= $number && $number > 0) {
            $removeStock = "UPDATE articles SET Stock = Stock - $number WHERE id = '$articleID'";
            executeQueryUpdate($removeStock);

            $insertQuery = "INSERT INTO basket (Username, Article_ID, Number) VALUES ('$username', '$articleID', '$number')";
            executeQueryUpdate($insertQuery);
            return true;
        } else {
            return false;
        }
    }
}

/*
 * Display function
 * Do: load articles in basket for basket page
 *
*/
function Display(): array
{
    $id_user = $_SESSION['id_user'];
    $articlesQuery = "SELECT * FROM basket WHERE Username = '$id_user'";
    $articlesResult = executeQuerySelect($articlesQuery);
    $articleDetails = array();

    if (!empty($articlesResult)) {
        foreach ($articlesResult as $article) {
            $articleIDs = explode(',', $article['Article_ID']);
            $numbers = explode(',', $article['Number']);

            $basketID = $article['id'];

            for ($i = 0; $i < count($articleIDs); $i++) {
                $articleID = $articleIDs[$i];
                $number = $numbers[$i];

                $articleDetailsQuery = "SELECT * FROM articles WHERE id = '$articleID'";
                $articleDetailsResult = executeQuerySelect($articleDetailsQuery);

                if (!empty($articleDetailsResult)) {
                    $articleDetails[] = array(
                        'ArticleID' => $articleID,
                        'BasketID' => $basketID,
                        'Image' => $articleDetailsResult[0]['Imagepath'],
                        'Name' => $articleDetailsResult[0]['Name'],
                        'Brand' => $articleDetailsResult[0]['Brand'],
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

/*
 * Remove function
 * Do: Remove articles in basket table
 *
*/
function Remove($basketID, $value, $articleID):bool {
    $articlesQuery = "UPDATE articles SET Stock = Stock + $value WHERE id = $articleID";
    executeQueryUpdate($articlesQuery);

    $basketQuery = "SELECT Article_ID, Number FROM basket WHERE id = $basketID";
    $basketResult = executeQuerySelect($basketQuery);

    if (!empty($basketResult)) {
        $articleIDs = explode(',', $basketResult[0]['Article_ID']);
        $numbers = explode(',', $basketResult[0]['Number']);

        $index = array_search($articleID, $articleIDs);
        if ($index !== false) {
            unset($articleIDs[$index]);
            unset($numbers[$index]);

            $newArticleID = implode(',', $articleIDs);
            $newNumber = implode(',', $numbers);

            $updateQuery = "UPDATE basket SET Article_ID = '$newArticleID', Number = '$newNumber' WHERE id = $basketID";
            executeQueryUpdate($updateQuery);
            return true;
        }
    }

    return false;
}




