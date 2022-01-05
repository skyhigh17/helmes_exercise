<?php

function db(){
    try
    {
        $db = new PDO("".DB_CONNECTION.":host=".DB_SERVER.";dbname=".DB_NAME."", DB_USERNAME, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $db;
    } 
        catch(PDOException $e) 
    {
        return "Connection failed: " . $e->getMessage();
    }
}

?>