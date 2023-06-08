<?php

require_once SOURCE_DIR.'/models/login.php';

if(isset($_POST['insert']))
{
    $id_user = $_POST['id_user'];
    $password = $_POST['password'];
}
$isAdmin = TestLogin($id_user, $password);
if ($isAdmin) header("Location:index.php?action=admin");
else header("Location:index.php?action=home");
