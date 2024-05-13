<?php require_once 'functions.php'; ?>
<?php
// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if
    (
        isset($_POST["nom"]) && !empty($_POST["nom"])
        &&
        isset($_POST["email"]) && !empty($_POST["email"])
        &&
        isset($_POST["date_de_naissance"]) && !empty($_POST["date_de_naissance"])
    )
    {
        // Validation des données du formulaire
        $nom = cleanStringInput($_POST["nom"]);
        $email = cleanStringInput($_POST["email"]);
        $date_de_naissance = cleanStringInput($_POST["date_de_naissance"]);

        // Vérification de la validité de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Adresse email invalide");
        }
        $conn = db_connect();
        // Préparation de la requête SQL d'insertion avec des requêtes préparées
        $studentID = uniqid();
        $stmt = $conn->prepare("INSERT INTO student (id, nom, email, date_de_naissance) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $studentID, $nom, $email, $date_de_naissance);

        // Exécution de la requête préparée
        $stmt->execute();

        // Fermeture de la connexion et du statement
        $stmt->close();
        $conn->close();

        header("location: index.php");
        exit();
    }
    else{
        http_response_code(500);
        die();        
    }
}
else{
    http_response_code(404);
    die();
}