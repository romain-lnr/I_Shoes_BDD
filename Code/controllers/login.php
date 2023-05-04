<?php
/*
 * Login Function
 * Do: redirect to login page
 *
*/
function Login() {
    require "views/login.php";
}

/*
 * CheckLogin Function
 * Do: Check the logged user
 *
*/
function CheckLogin() {
    require "models/login.php";
    if(isset($_POST['insert'])) {

        // Retrieves values
        $id_user = $_POST['id_user'];
        $password = $_POST['password'];
    }
    $isAdmin = TestLogin($id_user, $password);

    if ($isAdmin) header("Location:index.php?action=admin");
    else header("Location:index.php?action=home");
}
