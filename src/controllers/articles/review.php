<?php
require_once SOURCE_DIR. '/models/site/articlesService.php';

if ($bag['method'] == 'POST') {

    $articleId = 0;
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'stock_number_') === 0) {
            echo ">";
            $articleId++;
            $newStock = $_POST['stock_number_' . $articleId];
            $bag['data'] = ['article' => UpdateArticlesStockInDatabase($articleId, $newStock)];
        }
    }
}
$bag['response_headers'] = ['Location' => '/articles/home/'];
return $bag;