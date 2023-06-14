<?php

require_once SOURCE_DIR. '/models/site/basketService.php';

$bag['data'] = Remove($bag['basketID'], $bag['value'], $bag['articleID']);
$bag['response_headers'] = ['Location' => '/users/basket/'];
return $bag;
