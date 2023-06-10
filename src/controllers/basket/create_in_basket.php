<?php

require_once SOURCE_DIR.'/models/site/articles.php';

$value = $_POST['value'];
PutInBasket($_SESSION['id_user'], $bag['articleID'], $value);
$bag['view'] = header("Location: " . route("articles/home/"));
return $bag;