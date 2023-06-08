<?php
require SOURCE_DIR. "/models/site/articles.php";
$bag['data'] = GetArticles();
$bag['view'] = 'views/site/home';
return $bag;