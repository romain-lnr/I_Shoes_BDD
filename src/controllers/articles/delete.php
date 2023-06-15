<?php

require_once SOURCE_DIR. '/models/site/articlesService.php';
$bag['data'] = ['article' => Delete($bag['articleID'])];
$bag['response_headers'] = ['Location' => '/articles/admin/'];
return $bag;
