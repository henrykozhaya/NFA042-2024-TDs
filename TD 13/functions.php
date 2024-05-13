<?php
session_start();
function cleanStringInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function db_connect(){
    $conn = null;
    // Connexion à la base de données
    $servername = "localhost";
    $username = "nfa042_user";
    $password = "nfa042_pass";
    $dbname = "nfa042_db";
    try{
        $conn = new mysqli($servername, $username, $password, $dbname);
    }
    catch(Exception $e){
        die(str($e->getMessage()));
    }
    finally{
        if(!$conn) die("MySQL Connection Error ");
        return $conn;
    }
}