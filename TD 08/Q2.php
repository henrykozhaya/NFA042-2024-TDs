<?php
function verifier_cell_liban($num):bool{
    $pattern = "/^(\+961|00961)(3|70|71|76|81)\d{6}$/";
    return preg_match($pattern, $num);
}

$nums = [
    "+961 70 500 560", // false
    "+96170500560", // true
    "0096170500560", // true
    "0096103500560", // false
    "009613500560", // true
    "009617050056", // false
    "009619500560", // false
    "0096129500560", // false
    "@Henry0096170500560Liban", // false
];

foreach($nums as $num){
    echo $num, " - ", verifier_cell_liban($num), "\n";
}