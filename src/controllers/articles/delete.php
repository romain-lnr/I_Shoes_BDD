<?php

require SOURCE_DIR . "/models/site/articlesService.php";
$bag['data'] = Delete($bag['articleID']);
$bag['view'] = header("Location: " . route("articles/admin/"));
return $bag;
