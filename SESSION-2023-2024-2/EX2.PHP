<?php
function sanitizeText($text){
    return $text;
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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if
    (
        isset($_POST["titre"]) && !empty($_POST["titre"])
        &&
        isset($_POST["auteur"]) && !empty($_POST["auteur"])
        &&
        isset($_POST["edition"]) && !empty($_POST["edition"])
        &&
        isset($_POST["resume"]) && !empty($_POST["resume"]) 
        &&
        isset($_POST["prix"]) && !empty($_POST["prix"])
    )
    {
        extract($_POST);
        $titre = sanitizeText($titre);
        $auteur = sanitizeText($auteur);
        $prix = sanitizeText($prix);
        $date_edition = sanitizeText($date_edition);

        $conn = db_connect();

        $query = "INSERT INTO book (titre, auteur, resume, prix, date_edition, temps_de_creation) VALUE(?, ?, ?, ?, ?, now())";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssis', $titre, $auteur, $resume, $prix, $edition);

        $stmt->execute();

        echo $stmt->insert_id;

        $stmt->close();
        $conn->close();

    }
}
else{
    http_response_code(404);
    exit();
}