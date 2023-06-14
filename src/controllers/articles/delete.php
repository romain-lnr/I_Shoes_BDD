<?php

require SOURCE_DIR . "/models/site/articlesService.php";
$bag['data'] = Delete($bag['articleID']);
$bag['response_headers'] = ['Location' => '/articles/admin/'];
return $bag;
