<?php
// Créez une fonction PHP appelée afficher_date_heure qui affiche la date et l'heure actuelles au format "jour/mois/année heure:minute:seconde".

// Option 1 en utilisant Date()
function afficher_date_heure_1(){
    echo Date("d/m/Y H:i:s");
}

// Option 2 en utilisant new DateTime()
function afficher_date_heure_2(){
    $currentTime = new DateTime();
    echo $currentTime->format("d/m/Y H:i:s");
}

afficher_date_heure_1();
afficher_date_heure_2();