<?php

require_once SOURCE_DIR.'/models/site/basketService.php';

$value = $_POST['value'];
$bag['data'] = PutInBasket($_SESSION['id_user'], $bag['articleID'], $value);

if (!$bag['data']) {
    // erreur ici
}
$bag['view'] = header("Location: " . route("articles/home/"));
return $bag;