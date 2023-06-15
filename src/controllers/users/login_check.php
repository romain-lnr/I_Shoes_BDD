<?php
require_once SOURCE_DIR. '/models/site/usersService.php';


if ($bag['method'] == 'POST') {

    $id_user = $_POST['id_user'];
    $password = $_POST['password'];

    $bag['data'] = ['users' => LoginCheck($id_user, $password)];

    if (!$bag['data']['users']) {
        $bag['view'] = 'views/site/login';
        $bag['data'] = array('error' => 'LogNotTrue');
        $bag['layout'] = 'views/layout_form';
    } else {
        $bag['data'] = ['admin' => IsAdmin($id_user)];

        if ($bag['data']['admin']) $bag['response_headers'] = ['Location' => '/articles/admin/'];
        else $bag['response_headers'] = ['Location' => '/articles/home/'];
    }
}

return $bag;
