<?php

require_once SOURCE_DIR. '/models/site/purchasesService.php';

$bag['data'] = Create($_SESSION['id_user']);
$bag['response_headers'] = ['Location' => '/articles/purchases/'];
return $bag;
