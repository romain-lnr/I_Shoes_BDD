<?php
require SOURCE_DIR . "/models/site/articles.php";
$bag['data'] = Delete($bag['articleID']);

//header("Location: " . route("articles/admin/"));
//return $bag;
