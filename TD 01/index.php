<?php
$age = 12.3;

echo verifier_age_3($age);
function verifier_age_1($age){
     if(intval($age) === $age) return true;
     return false;
}
function verifier_age_2($age){
    return is_int($age);
}
function verifier_age_3($age){
    return gettype($age) == "integer";
}