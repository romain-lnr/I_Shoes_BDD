<?php
require SOURCE_DIR . "/models/site/articles.php";

if ($bag['method'] == 'POST') {

    $articleId = 0;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'stock_number_') === 0) {
            echo ">";
            $articleId++;
            $newStock = $_POST['stock_number_' . $articleId];
            UpdateArticlesStockInDatabase($articleId, $newStock);
        }
    }
}
header("Location: " . route("users/home/"));