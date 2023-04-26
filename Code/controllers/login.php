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
    require "models/model.php";
    if(isset($_POST['insert'])) {

        // Retrieves values
        $id_user = $_POST['id_user'];
        $password = $_POST['password'];
    }
    Test_login($id_user, $password);
}

/*
 * Account Function
 * Do: Create a new account
 *
*/
function Account() {
    require "models/model.php";

    if(isset($_POST['insert'])) {

        // Retrieves values
        $id_user = $_POST['id_user'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
    Insert_user($id_user, $prenom, $nom, $email, $password);
}
