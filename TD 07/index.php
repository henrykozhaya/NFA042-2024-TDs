<?php
    // Question 1
    $filename = "data.txt";

    if(!file_exists($filename)){
        $content = "nom,prenom,age\n";

        $file = fopen($filename, "w") or die("Can't open/create the file $filename");
        fwrite($file, $content);
    
        fclose($file);
    
        echo "<div>File created successfully!</div>";
    }

    ajouter_personne("Albert", "Mansour", 18);
    ajouter_personne("Charbel", "Hakim", 18);
    ajouter_personne("Charbel", "Karam", 18);
    ajouter_personne("George", "Tannous", 18);
    ajouter_personne("Miled", "M..", 18);

    // Question 2
    $file = fopen($filename, "r") or die("Can't open the file $filename");
    $dataArr = [];

    $header = fgets($file);
    $keys = explode(",", trim($header));

    while(!feof($file)){
        $line = fgets($file);
        if(empty($line)) break;
        $values = explode(",", trim($line));
        $dataArrElement = array_combine($keys, $values);
        // array_push($dataArr, $dataArrElement);
        // OR
        $dataArr[] = $dataArrElement;
    }
    fclose($file);
    echo "<div>Array created successfully!</div>";
    echo "<br>";

    $html = "<table border='1' cellpadding='5' cellspacing='0'>";
    $html .= "<thead>";
    foreach($keys as $key)
    {
        $html .= "<th>$key</th>";
    }
    $html .= "</thead>";
    $html .= "<tbody>";
    foreach($dataArr as $personInfo){
        $html .= "<tr>";
        foreach($personInfo as $attribute){
            $html .= "<td>$attribute</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</tbody>";
    $html .= "</table>";
    echo $html;

    // Question 3
    function ajouter_personne($nom, $prenom, $age) {
        if(empty($nom) || empty($prenom) || empty($age)) return false;
        global $filename;
        $file = fopen($filename, 'a') or die("Unable to open the file $filename");
        $newLine = "$nom,$prenom,$age\n";
        fwrite($file, $newLine);
        fclose($file);
    }

