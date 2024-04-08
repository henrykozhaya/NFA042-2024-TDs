<?php

// Vérifier si les données sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Créer le nom du fichier
    extract($_POST);
    $filename = date("Y-m-d") . "-" . $name . "-" . $position . ".json";
    
    $data = $_POST;
    $data["submission_date"] = date("Y-m-d H:i:s");

    $json_data = json_encode($data, JSON_PRETTY_PRINT);

    file_put_contents($filename, $json_data);

    die("Les données ont étées sauvegarder");
} 
else {
    header("Location: form.php");
    exit();
}