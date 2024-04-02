<?php
// Créez une fonction PHP appelée modifier_variable_globale qui prend en paramètre une valeur et qui modifie une variable globale nommée $_GLOBALS['variable_globale'] pour lui attribuer cette valeur. 
// Ensuite, écrivez une autre fonction appelée afficher_variable_globale qui affiche la valeur de $_GLOBALS['variable_globale']. Enfin, utilisez ces deux fonctions pour modifier et afficher la variable globale $_GLOBALS['variable_globale'] dans le script principal.
function modifier_variable_globale($valeur){
    $GLOBALS['variable_globale'] = $valeur;
}

function afficher_variable_globale(){
    if(isset($GLOBALS['variable_globale'])) echo $GLOBALS['variable_globale'];
    else echo "La variable \$_GLOBALS['variable_globale'] n'existe pas.";

}

modifier_variable_globale("Cnam Bickfaya");
afficher_variable_globale();