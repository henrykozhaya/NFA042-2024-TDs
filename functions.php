<?php

function mysqldb(){
    // Paramètres de connexion
    $servername = "localhost";
    $username = "nfa042_user";
    $password = "nfa042_pass";
    $database = "nfa042_db";

    $conn = null;

    try {
        // Establishing the connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check for connection errors
        if ($conn->connect_errno) {
            throw new Exception("Failed to connect to MySQL: " . $conn->connect_error);
        }
        
        echo "Connection to MySQL is successful";
    } 
    catch (Exception $e){        
        // Displaying error message
        echo "Error while connecting to MySQL \n";
        echo $e->getMessage();
    }
    return $conn;
}