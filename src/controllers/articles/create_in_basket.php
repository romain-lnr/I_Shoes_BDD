<?php

require_once SOURCE_DIR.'/models/site/articles.php';

$value = $_POST['value'];
PutInBasket($bag['articleID'], $value);
header("Location: " . route("users/home/"));
return $bag;