<?php

// Vérifier si les données sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    extract($_POST);
    
    // {année}-{mois}-{jour}-{nom}-{position}
    $path = Date("Y-m-d") . "-" . $name . "-" . $position;
    if(!file_exists($path)) {
        if(!mkdir($path)){
            die("No permission to create a directory!");                            
        }
    }

    $data = $_POST;
    $data["submission_date"] = date("Y-m-d H:i:s");
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    // {année}-{mois}-{jour}-data-{nom}-{position}.json
    $JSONFileName = date("Y-m-d") . "-data-" . $name . "-" . $position . ".json";
    $JSONFullpath = $path . "/" . $JSONFileName;
    $file = fopen($JSONFullpath, "w");
    fwrite($file, $jsonData);
    fclose($file);

    // Check if the user uploaded a CV in PDF
    if(isset($_FILES["cv"]) && $_FILES["cv"]["size"] > 0 && $_FILES["cv"]["error"] == 0){
        if($_FILES["cv"]["type"] == "application/pdf" ){

            // {année}-{mois}-{jour}-cv-{nom}-{position}.pdf
            $extension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
            $cvFileName = date("Y-m-d") . "-cv-" . $name . "-" . $position . "." . $extension;         
            $cvFullpath = $path . "/" . $cvFileName;
            move_uploaded_file($_FILES["cv"]["tmp_name"], $cvFullpath);   
        }
        else{
            die("Le document n'est pas en PDF");
        }
    }
    exit("Les données ont étées sauvegarder");
} 
else {
    header("Location: form.php");
    exit();
}