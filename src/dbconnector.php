<?php
function executeQuerySelect($query):array{
    $queryResult = null;

    $dbConnexion = openDBConnexion();
    if ($dbConnexion != null)
    {
        $statement = $dbConnexion->prepare($query);
        $statement->execute();
        $queryResult = $statement->fetchAll();
    }
    $dbConnexion = null;
    return $queryResult;
}

function executeQueryInsert($query):bool{
    $queryResult = null;

    $dbConnexion = openDBConnexion();
    if ($dbConnexion != null)
    {
        try{
            $statement = $dbConnexion->prepare($query);
            $queryResult = $statement->execute();
        }
        catch (PDOException $exception){
            error_log('Duplicate Entry: ' . $exception->getMessage() . "\r\n", 3, ERROR_LOG);
            $queryResult = false;
        }
    }
    $dbConnexion = null;
    return $queryResult;
}

function executeQueryUpdate($query):bool{
    $queryResult = null;

    $dbConnexion = openDBConnexion();
    if ($dbConnexion != null)
    {
        try{
            $statement = $dbConnexion->prepare($query);
            $queryResult = $statement->execute();
        }
        catch (PDOException $exception){
            error_log('Error during updating process: ' . $exception->getMessage() . "\r\n", 3, ERROR_LOG);
            $queryResult = false;
        }
    }
    $dbConnexion = null;
    return $queryResult;
}

function openDBConnexion (){
    $tempDbConnexion = null;

    $sqlDriver = 'mysql';
    $hostname = 'localhost';
    $port = 3306;
    $charset = 'utf8';
    $dbName = 'i_shoes';
    $userName = 'user';
    $userPwd = 'pa$$w0rd';
    $dsn = $sqlDriver . ':host=' . $hostname . ';dbname=' . $dbName . ';port=' . $port . ';charset=' . $charset;

    try{
        $tempDbConnexion = new PDO($dsn, $userName, $userPwd);
    }
    catch (PDOException $exception) {
        var_dump($exception);
        error_log('Connection failed: ' . $exception->getMessage()  . "\r\n", 3, ERROR_LOG);
    }
    return $tempDbConnexion;
}