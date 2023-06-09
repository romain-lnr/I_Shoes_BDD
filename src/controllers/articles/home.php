<?php
require SOURCE_DIR . "/models/site/articles.php";
$bag['data'] = GetArticlesForHome();
$bag['view'] = 'views/site/home';
return $bag;