<?php
require SOURCE_DIR . "/models/site/articlesService.php";

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
$bag['view'] = header("Location: " . route("articles/home/"));
return $bag;