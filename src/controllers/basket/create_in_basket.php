<?php

require_once SOURCE_DIR. '/models/site/basketService.php';

if (!isset($_SESSION['id_user'])) {
    $bag['view'] = 'views/site/login';
    $bag['data'] = array('error' => 'NotLog');
    $bag['layout'] = 'views/layout_form';
} else {

    $value = $_POST['value'];
    $bag['data'] = PutInBasket($_SESSION['id_user'], $bag['articleID'], $value);

    if (empty($bag['data'])) {
        $_SESSION['error'] = 'NotEvenStock';
    }
    $bag['response_headers'] = ['Location' => '/articles/home/'];
}
return $bag;