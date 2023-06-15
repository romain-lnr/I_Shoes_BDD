<?php

require_once SOURCE_DIR. '/models/site/purchasesService.php';

$bag['data'] = ['purchases' => Refresh($_SESSION['id_user'])];
$bag['response_headers'] = ['Location' => '/articles/home/'];
return $bag;
