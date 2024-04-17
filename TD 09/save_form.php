<?php

// Vérifier si les données sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    extract($_POST);
    
    // {année}-{mois}-{jour}-{nom}-{position}.json
    $JSONFileName = date("Y-m-d") . "-" . $name . "-" . $position . ".json";
    
    $data = $_POST;
    $data["submission_date"] = date("Y-m-d H:i:s");
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    $file = fopen($JSONFileName, "w");
    fwrite($file, $jsonData);
    fclose($file);

    die("Les données ont étées sauvegarder");
} 
else {
    header("Location: form.php");
    exit();
}