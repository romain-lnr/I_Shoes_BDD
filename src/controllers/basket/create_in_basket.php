<?php

require_once SOURCE_DIR.'/models/site/basket.php';

$value = $_POST['value'];
$bag['data'] = PutInBasket($_SESSION['id_user'], $bag['articleID'], $value);
$bag['view'] = header("Location: " . route("articles/home/"));
return $bag;