<?php

require_once SOURCE_DIR. '/models/site/basketService.php';

$bag['data'] = ['basket' => Display()];
$bag['view'] = 'views/site/basket';
return $bag;
