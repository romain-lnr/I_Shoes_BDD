<?php

require_once SOURCE_DIR. '/models/site/articlesService.php';

$bag['data'] = ['article' => ShowArticle($bag['articleID'])];
$bag['view'] = 'views/site/show_article';
return $bag;
