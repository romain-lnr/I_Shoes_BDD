<?php
require SOURCE_DIR."/models/articles.php";
$i = -1;
do {
    $i++;
    $article_specs[$i] = DisplayArticles($i);
} while ($article_specs[$i] != null);
$bag['view'] = 'views/site/home.php';