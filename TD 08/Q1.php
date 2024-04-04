<?php
function verifier_email($email):bool{
    $pattern = "/^[a-z]\w*[a-z]@[a-z]{2,}(.[a-z]{2,63})+$/i";
    return preg_match($pattern, $email);
}

$emails = [
    "john@isae.edu.lb",
    "john@cnam.fr",
    "j0hn@cnam.fr", // Zero à la place de o
    "john@cnam.fr",
    "john@cnam.fr",
    "j4@cnam.fr",
    "j@cnam.fr",
    "jo@cnam.fr",
    "jo@c.fr",
    "jo@cnam.f",
    "jo@cnam.com",
    "jo@cnam.group",
    "jo@cnam.com@Liban",
];

foreach($emails as $email){
    echo $email, " - ", verifier_email($email), "\n";
}