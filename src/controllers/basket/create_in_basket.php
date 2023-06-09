<?php

require_once SOURCE_DIR.'/models/site/articles.php';

$value = $_POST['value'];
PutInBasket($bag['articleID'], $value);
$bag['view'] = header("Location: " . route("users/home/"));
return $bag;