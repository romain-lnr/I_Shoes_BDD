<?php
/*
 * TestLogin Function
 * Do: verify user informations in login page
 *
*/
function TestLogin($id_user, $password)  {

    // Load the file
    $jsonfile = 'data/dataUsers.json';
    $data = file_get_contents($jsonfile);
    // DECODE JSON flow
    $obj = json_decode($data);

    $isAdmin = false;
    // access the appropriate element
    for ($i = 0; $i < count($obj); $i++) {
        if ($obj[$i]->username == $id_user) {
            if (password_verify($password, $obj[$i]->password)) {
                $_SESSION['id_user'] = $obj[$i]->username;
                $_SESSION['logged'] = true;
                if ($id_user == "admin" && $password == "admin") {
                    $isAdmin = true;
                    $_SESSION['admin_logged'] = true;
                }
                else {
                    $isAdmin = false;
                    $_SESSION['admin_logged'] = false;
                }
            } else header("Location:index.php?error=password_not_correct");
        } else header("Location:index.php?error=user_not_correct");
    }
    return $isAdmin;
}
