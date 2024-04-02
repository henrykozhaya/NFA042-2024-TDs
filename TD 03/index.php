<?php
// Créez une fonction PHP appelée afficher_jours_semaine qui crée un tableau contenant les jours de la semaine. 
// Ensuite, utilisez une boucle dans cette fonction pour afficher chaque jour de la semaine sur une nouvelle ligne.

/* Solution */
function afficher_jours_semaine(){

    $jours_semaine = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

    foreach($jours_semaine as $jour) echo "$jour \n";


}

// afficher_jours_semaine();
/* End OF Solution */

// How can I generate and display the dates for today and the next seven days in the following format:
// Day of the week followed by the day of the month (e.g., "Wednesday 20", "Thursday 21")?    
$todaysDate = new DateTime();
$currentDate = clone $todaysDate;
$iterations = 0;
while(true){
    echo $currentDate->format('l d') . "\n";
    $currentDate->modify('+1 day');
    if($currentDate->diff($todaysDate)->days == 7) break;
}