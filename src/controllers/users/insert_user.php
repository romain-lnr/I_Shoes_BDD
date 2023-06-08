<?php

require SOURCE_DIR. "/models/site/users.php";

if ($bag['method'] == 'POST') {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $bag['data'] = Insert($id_user, $name, $firstname, $email, $password);
}
$bag['view'] = 'views/site/login';
return $bag;