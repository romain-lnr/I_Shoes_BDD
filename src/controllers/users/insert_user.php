<?php

require SOURCE_DIR. '/models/site/usersService.php';

if ($bag['method'] == 'POST') {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $bag['data'] = ['users' => Insert($id_user, $name, $firstname, $email, $password)];

    if (!$bag['data']['users']) {
        $bag['data'] = array('error' => 'UserNotUnique');
        $bag['view'] = 'views/site/new_user';
    } else {
        $bag['view'] = 'views/site/login';
    }
}
return $bag;