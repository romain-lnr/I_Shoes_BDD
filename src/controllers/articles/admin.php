<?php
require SOURCE_DIR . "/models/site/articles.php";
$bag['data'] = GetArticlesForAdmin();
$bag['view'] = 'views/site/admin';
return $bag;
