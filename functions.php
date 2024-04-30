<?php

function mysqldb(){
    // Paramètres de connexion
    $servername = "localhost";
    $username = "nfa042_user";
    $password = "nfa042_pass";
    $dbname = "nfa042_db";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    return $conn;
}