<?php
function afficher_tableau($myArray){
    if(sizeof($myArray) == 0) exit();
    $html = "<table border='1' cellspacing='0' cellpadding='5'>";
    $html .= "<thead class='headerRow'>";
    for($i=0; $i<sizeof($myArray[0]); $i++) $html .= "<th>".$myArray[0][$i]."</th>";
    $html .= "</thead>";
    $html .= "<tbody>";

    array_shift($myArray); // We removed the first row (element) of $myArray
    // We used array_shift to refresh our memory. We could use for($i=1; $i<sizeof($myArray); $i++)

    $count = 1;
    foreach($myArray as $row){
        $rowClassName = $count%2==0?"evenRow":"oddRow";
        $html .= "<tr class='$rowClassName'>";

        foreach($row as $cell) $html .= "<td>".$cell."</td>";
        $html .= "</tr>";
        $count++;
    }

    $html .= "</tbody>";
    $html .= "</table>";
    return $html;
}

$students = array(
    array("Name", "Age", "Country"),
    array("John", 25, "USA"),
    array("Alice", 30, "UK"),
    array("Bob", 22, "Canada"),
    array("Emily", 28, "Australia"),
    array("David", 35, "Germany")
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