<?php
session_start();
if(!isset($_SESSION["user"])) checkCookieToken();

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

function setCookieToken($username){
    $t_user = uniqid();

    $conn = db_connect();
    $query = "UPDATE users SET token = ? WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $t_user, $username);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
    setcookie("t_user", $t_user, time() + 3600, "/");
}

function checkCookieToken(){
    if(isset($_COOKIE["t_user"])){
        $t_user = $_COOKIE["t_user"];

        $conn = db_connect();
        $query = "SELECT id, username, name, email FROM users WHERE token = '$t_user'";
        $result = $conn->query($query);
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            
            // To reset the token
            setCookieToken($row["username"]);

            $_SESSION["user"]["id"] = $row["id"];
            $_SESSION["user"]["name"] = $row["name"];
            $_SESSION["user"]["username"] = $row["username"];

            header("location:index.php");
        }
    }
}