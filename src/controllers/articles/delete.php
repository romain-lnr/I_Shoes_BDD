<?php

require SOURCE_DIR . "/models/site/articles.php";
$bag['data'] = Delete($bag['articleID']);
$bag['view'] = header("Location: " . route("articles/admin/"));
return $bag;
