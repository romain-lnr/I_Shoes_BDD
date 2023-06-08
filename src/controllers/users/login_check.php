<?php

require SOURCE_DIR. "/models/site/users.php";

if (isset($_POST)) {

    $id_user = $_POST['id_user'];
    $password = $_POST['password'];

    $bag['data'] = LoginCheck($id_user, $password);
    $bag['view'] = 'views/site/home';
}
return $bag;
