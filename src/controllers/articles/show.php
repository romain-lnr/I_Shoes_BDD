<?php

require_once SOURCE_DIR.'/models/articles.php';

$bag['data'] = ['article' => ShowArticle($bag['articleId'])];
$bag['view'] = 'views/site/show_articles.php';
return $bag;
