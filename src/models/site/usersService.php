<?php
require SOURCE_DIR. "/dbconnector.php";

/*
 * isEmailUsed function
 * Do: Verify if the email is used
 *
*/
function IsEmailUsed($email) {
    $email = addslashes($email);
    $query = "SELECT COUNT(*) as count FROM users WHERE Email = '$email'";
    $result = executeQuerySelect($query);
    $count = $result[0]['count'];
    return $count;
}

/*
 * Insert function
 * Do: Insert the user in the users table
 *
*/
function Insert($id_user, $name, $firstname, $email, $password): bool {

    if (IsEmailUsed($email)) {
        return false;
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

/*
 * LoginCheck function
 * Do: Verify if the login is in the database
 *
*/
function LoginCheck($id_user, $password):bool {
    $query = "SELECT COUNT(*) as count FROM users WHERE Username = '$id_user' OR Email = '$id_user';";
    $result = executeQuerySelect($query);
    $count = $result[0]['count'];

    if (!$count) {
        $result = false;
    } else {
        $query = "SELECT Password FROM users WHERE Username = '$id_user' OR Email = '$id_user';";
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
        }
    }
    return $result;
}

