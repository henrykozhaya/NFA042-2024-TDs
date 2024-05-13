<?php
// Validation des entrées
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données du formulaire
    $nom = validateInput($_POST["nom"]);
    $email = validateInput($_POST["email"]);
    $date_de_naissance = validateInput($_POST["date_de_naissance"]);

    // Vérification de la validité de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Adresse email invalide");
    }

    // Connexion à la base de données
    $servername = "localhost";
    $username = "nfa042_user";
    $password = "nfa042_pass";
    $dbname = "nfa042_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparation de la requête SQL d'insertion avec des requêtes préparées
    $studentID = uniqid();
    $stmt = $conn->prepare("INSERT INTO student (id, nom, email, date_de_naissance) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $studentID, $nom, $email, $date_de_naissance);

    // Exécution de la requête préparée
    $stmt->execute();

    // Fermeture de la connexion et du statement
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
else{
    
}