<?php
/*
 * InsertUser Function
 * Do: Create an account in dataUsers json file
 *
*/
function InsertUser($id_user, $firstname, $name, $email, $password) {

    // Load the file
    $jsonfile = 'data/dataUsers.json';
    $contents = file_get_contents($jsonfile);

    // HASH Password
    $passhash = password_hash($password, PASSWORD_DEFAULT);

    // Decode the JSON data into a PHP array.
    $json = json_decode($contents, true);
    $user = array_search($id_user, array_column( $json, 'username' ) );
    if ($user !== false) {
        header("Location:index.php?error=user_not_unique");
        return;
    }
    else {
        $json[] = array("username" => $id_user, "firstname" => $firstname, "name" => $name, "Email" => $email, "password" => $passhash);
    }

    // Encode the array back into a JSON string.
    $encode = json_encode($json, JSON_PRETTY_PRINT);

    // Save the file.
    file_put_contents('data/dataUsers.json', $encode);
}
