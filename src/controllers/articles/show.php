<?php

require_once SOURCE_DIR.'/models/site/articles.php';

$bag['data'] = ShowArticle($bag['articleID']);
$bag['view'] = 'views/site/show_article';
return $bag;
