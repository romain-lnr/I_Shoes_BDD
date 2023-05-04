<?php
/*
 * Register Function
 * Do: redirect to new_user page
 *
*/
function Register() {
    require "views/new_user.php";
}

/*
 * Account Function
 * Do: Create a new account
 *
*/
function Account() {
    require "models/users.php";

    if(isset($_POST['insert'])) {

        // Retrieves values
        $id_user = $_POST['id_user'];
        $firstname = $_POST['firstname'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
    InsertUser($id_user, $firstname, $name, $email, $password);
    header("Location:index.php?action=login");
}
/*
 * LostPage Function
 * Do: redirect to the lost page
 *
*/
function LostPage() {
    require "views/lost.php";
}

/*
 * Logout Function
 * Do: destroy sessions variable and log out the user
 *
*/
function Logout() {
    $_SESSION['logged'] = false;
    session_destroy();
    header("Location:index.php");
    exit();
}