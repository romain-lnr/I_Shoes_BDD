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