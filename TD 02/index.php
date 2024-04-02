<?php
// Créez une fonction PHP appelée traiter_chaine qui prend une chaîne de caractères en entrée. 
// La fonction doit vérifier si la chaîne est vide, puis retourner la longueur de la chaîne et la chaîne inversée sous forme de tableau.

$myString = "Cnam Bickfaya";
// $myString = "";

print_r(traiter_chaine($myString));

function traiter_chaine($myString){
    $result = [
        "length" => strlen($myString),
        "reversedString" => str_split(strrev($myString))
    ];
    // La fonction doit vérifier si la chaîne est vide
    // Option 1: strlen
    if(strlen($myString) == 0) return false;
    // Option 2: empty
    if(empty($myString)) return false;

    return $result;
}