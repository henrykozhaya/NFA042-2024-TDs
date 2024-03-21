<?php
function afficher_tableau($myArray){
    if(sizeof($myArray) == 0) exit();
    $html = "<table border='1' cellspacing='0' cellpadding='5'>";
    $html .= "<thead class='headerRow'>";
    
    $keys = array_keys($myArray[0]);
    for($i=0; $i<sizeof($keys); $i++) $html .= "<th>".$keys[$i]."</th>";
    
    $html .= "</thead>";
    $html .= "<tbody>";

    $count = 1;
    foreach($myArray as $row){
        $rowClassName = $count%2==0?"evenRow":"oddRow";
        $html .= "<tr class='$rowClassName'>";
        
        foreach($row as $key=>$value) $html .= "<td class='$key'>".$value."</td>";
        
        $html .= "</tr>";
        $count++;
    }

    $html .= "</tbody>";
    $html .= "</table>";
    return $html;
}

$students = array(
    array("Name"=>"John", "Age"=>25, "Country"=>"USA"),
    array("Name"=>"Alice", "Age"=>30, "Country"=>"UK"),
    array("Name"=>"Bob", "Age"=>22, "Country"=>"Canada"),
    array("Name"=>"Emily", "Age"=>28, "Country"=>"Australia"),
    array("Name"=>"David", "Age"=>35, "Country"=>"Germany"),
);
?>

<html>
    <head>
        <style>
            .oddRow{
                background-color:#fff;
            }
            .evenRow{
                background-color:#ddd;
            }
            .headerRow{
                background-color:#555;
                color:#fff;
            }
        </style>
    </head>
    <body>
        <?= afficher_tableau($students); ?>
    </body>
</html>