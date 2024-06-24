<?php
use Carbon\Exceptions\EndLessPeriodException;
function sanitizeText($text){
    return $text;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if
    (
        isset($_FILES["file"]) 
        &&
        $_FILES["file"]["size"] > 0
        && 
        $_FILES["file"]["error"] == 0
        &&
        $_FILES["cv"]["type"] == "application/pdf"
        &&
        isset($_POST["filename"]) && !empty($_POST["filename"])
    )
    {
        extract($_POST);
        $filename = sanitizeText($filename);
        $filename = trim($filename);
        str_replace(" ", "-", $filename);
        $filename = strtolower($filename);

        $path = "assets/pdf/" . Date("Y") . "/" . Date("m") . "/" . Date("d");
        if(!file_exists($path)) {
            if(!mkdir($path)){
                die("No permission to create a directory!");                            
            }
        }    
        
        $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        move_uploaded_file($_FILES["file"]["tmp_name"], $path."/".$filename.".".$extension);

        echo "File uploaded successfully";

    }
    else{
        die("Erro uploading file");
    }
}
else{
    http_response_code(404);
    exit();
}