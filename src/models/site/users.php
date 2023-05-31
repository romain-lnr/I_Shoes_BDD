<?php
function TestLogin($id_user, $password) {

require_once SOURCE_DIR. "/models/dbconnector.php";
try {
    $query = executeQuerySelect("SELECT * FROM users LIKE '%$id_user'");
}
catch (PDOException $exception){
        error_log('Duplicate Entry: ' . $exception->getMessage() . "\r\n", 3, ERROR_LOG);
        $queryResult = false;
    }

}