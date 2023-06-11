<?php
require SOURCE_DIR . "/models/site/articlesService.php";
$bag['data'] = GetArticlesForAdmin();
$bag['view'] = 'views/site/admin';
return $bag;
