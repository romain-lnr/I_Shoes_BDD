<?php
require SOURCE_DIR . "/models/site/articles.php";

if ($bag['method'] == 'POST') {

    $articleId = 0;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'stock_number_') === 0) {
            echo ">";
            $articleId++;
            $newStock = $_POST['stock_number_' . $articleId];
            $bag['data'] = UpdateArticlesStockInDatabase($articleId, $newStock);
        }
    }
    // Faire quelque chose avec les articles mis à jour (par exemple, afficher un message de succès)
}
header("Location: " . route("users/home/"));
return $bag;