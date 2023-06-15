<?php

require_once SOURCE_DIR. '/models/site/purchasesService.php';

$bag['data'] = ['purchases' => Display($_SESSION['id_user'])];
$bag['view'] = 'views/site/purchases';
return $bag;
