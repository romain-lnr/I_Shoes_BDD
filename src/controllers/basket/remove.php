<?php

require_once SOURCE_DIR.'/models/site/basketService.php';

$bag['data'] = Remove($bag['basketID'], $bag['value'], $bag['articleID']);
$bag['view'] = header("Location: " . route("users/basket/"));
return $bag;
