<?php
require_once SOURCE_DIR. "/models/site/users.php";

// Retrieves values
$id_user = $_POST['id_user'];
$password = $_POST['password'];

$isAdmin = TestLogin($id_user, $password);

if ($isAdmin) $bag['view'] = "views/site/users/admin";
else $bag['view'] = "views/site/users/home";
return $bag;