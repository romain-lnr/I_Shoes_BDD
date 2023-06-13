<?php

require_once SOURCE_DIR.'/models/site/purchasesService.php';

$bag['data'] = Refresh($_SESSION['id_user']);
$bag['view'] = header("Location: " . route("articles/home/"));
return $bag;
