<?php

require_once SOURCE_DIR. "/models/site/users.php";
require_once SOURCE_DIR. "/dispatcher.php";

if (isset($_POST)) {

    $id_user = $_POST['id_user'];
    $password = $_POST['password'];

    $bag['data'] = LoginCheck($id_user, $password);

    if ($bag['data']) {

        $bag['layout'] = 'views/layout';
        if ($id_user == "admin" && $password == "admin") $bag['view'] = 'views/site/admin';
        else {
            // Redirection vers la page d'accueil
            header("Location: " . route("users/home/"));

        }
    } else {
        // erreur ici
        $bag['view'] = 'views/site/login';
        $bag['layout'] = 'views/layout_form';
    }
}
return $bag;
