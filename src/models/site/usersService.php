<?php
require SOURCE_DIR. "/dbconnector.php";

function IsEmailUsed($email) {
    $email = addslashes($email);
    $query = "SELECT COUNT(*) as count FROM users WHERE Email = '$email'";
    $result = executeQuerySelect($query);
    $count = $result[0]['count'];
    return $count;
}

function Insert($id_user, $name, $firstname, $email, $password): bool {

    // Vérifier si l'email est unique
    if (IsEmailUsed($email)) {

        // Erreur ici
        echo "YESS";
    }

    // To avoid special characters
    $name = addslashes($name);
    $firstname = addslashes($firstname);
    $email = addslashes($email);
    $password = addslashes($password);

    $passhash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (Name, Username, Firstname, Email, Password) VALUES ('$name', '$id_user', '$firstname', '$email', '$passhash');";
    return executeQueryInsert($query);
}

function LoginCheck($id_user, $password){
    $query = "SELECT COUNT(*) as count FROM users WHERE Username = '$id_user';";
    $result = executeQuerySelect($query);
    $count = $result[0]['count'];

    if (!$count) {
        $result = false;
        // Erreur ici
    } else {
        $query = "SELECT Password FROM users WHERE Username = '$id_user';";
        $password_true = executeQuerySelectSingle($query);

        if (password_verify($password, $password_true)) {

            $_SESSION['id_user'] = $id_user;
            $_SESSION['logged'] = true;

            if ($id_user == "admin" && $password == "admin") {
                $_SESSION['admin_logged'] = true;
            } else {
                $_SESSION['admin_logged'] = false;
            }
            $result = true;
        } else {
            $result = false;
            // Erreur ici
        }
    }
    return $result;
}

