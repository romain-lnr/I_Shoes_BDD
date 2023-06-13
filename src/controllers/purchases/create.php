<?php

require_once SOURCE_DIR.'/models/site/purchasesService.php';

$bag['data'] = Create($_SESSION['id_user']);
$bag['view'] = header("Location: " . route("articles/purchases/"));
return $bag;
