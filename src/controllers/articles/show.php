<?php

require_once SOURCE_DIR.'/models/articles.php';

$bag['data'] = ['article' => ShowArticle($bag['articleId'])];
$bag['view'] = 'views/articles/show';
return $bag;