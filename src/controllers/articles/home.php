<?php
require_once SOURCE_DIR. '/models/site/articlesService.php';
$bag['data'] = ['article' => GetArticlesForHome()];
$bag['view'] = 'views/site/home';
return $bag;