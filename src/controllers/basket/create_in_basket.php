<?php

require_once SOURCE_DIR. '/models/site/basketService.php';

if (!isset($_SESSION['id_user'])) {
    $bag['view'] = 'views/site/login';
    $bag['data'] = array('error' => 'NotLog');
    $bag['layout'] = 'views/layout_form';
} else {

    $value = $_POST['value'];
    $bag['data'] = ['basket' => PutInBasket($_SESSION['id_user'], $bag['articleID'], $value)];

    if (!($bag['data']['basket'])) $bag['response_headers'] = ['Location' => '/articles/NotEvenStock/'];
    else $bag['response_headers'] = ['Location' => '/articles/home/'];
}
return $bag;