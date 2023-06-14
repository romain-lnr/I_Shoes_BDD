<?php
require_once SOURCE_DIR. '/models/site/usersService.php';


if ($bag['method'] == 'POST') {

    $id_user = $_POST['id_user'];
    $password = $_POST['password'];

    $bag['data'] = LoginCheck($id_user, $password);

    if ($bag['data']) {

        $bag['layout'] = 'views/layout';
        if ($id_user == "admin" OR "admin@cpnv.ch" && $password == "admin") $bag['response_headers'] = ['Location' => '/articles/admin/'];
        else $bag['response_headers'] = ['Location' => '/articles/home/'];

    } else {
        $bag['view'] = 'views/site/login';
        $bag['data'] = array('error' => 'LogNotTrue');
        $bag['layout'] = 'views/layout_form';
    }
}

return $bag;
