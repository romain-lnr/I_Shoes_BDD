<?php
require SOURCE_DIR . "/models/site/articlesService.php";
$bag['data'] = GetArticlesForHome();
$bag['view'] = 'views/site/home';
return $bag;