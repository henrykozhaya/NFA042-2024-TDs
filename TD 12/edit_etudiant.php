<?php require_once 'functions.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(
        isset($_GET["id"]) && !empty($_GET["id"])
        &&
        isset($_POST["nom"]) && !empty($_POST["nom"])
        &&
        isset($_POST["email"]) && !empty($_POST["email"])
        &&
        isset($_POST["date_de_naissance"]) && !empty($_POST["date_de_naissance"])        
    )
    {
        $id = cleanStringInput($_GET["id"]);

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
        $stmt = $conn->prepare("UPDATE student SET nom=?, email=?, date_de_naissance=? WHERE id=?");
        $stmt->bind_param("ssss", $nom, $email, $date_de_naissance, $id);

        // Exécution de la requête préparée
        $stmt->execute();

        // Fermeture de la connexion et du statement
        $stmt->close();
        $conn->close();

        header("location: edit_etudiant.php?id=$id");
        exit();  
    }
    else{
        http_response_code(500);
        die();
    }
}
else if(($_SERVER["REQUEST_METHOD"] == "GET")){
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id = cleanStringInput($_GET["id"]);
        $conn = db_connect();
        $stmt = $conn->prepare("SELECT * FROM student WHERE id = ?");
        $stmt->bind_param("s", $id);
    
        // Exécution de la requête préparée
        $stmt->execute();

        $result = $stmt->get_result();

        // Fetch data from the result set
        $user = $result->fetch_assoc();
        extract($user);

        $stmt->close();
        $conn->close();
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gestion des Étudiants</title>
        </head>
        <body>
            <h3>Modifier un etudiant</h3>
            <form action="edit_etudiant.php?id=<?=$id?>" method="POST">
                <div style="margin-bottom:10px;">
                    <div>Nom</div>
                    <div><input type="text" name="nom" id="" value="<?= $nom ?>"></div>
                </div>
                <div style="margin-bottom:10px;">
                    <div>Email</div>
                    <div><input type="text" name="email" id="" value="<?= $email ?>"></div>
                </div>
                <div style="margin-bottom:10px;">
                        <div>Date de Naissance</div>
                        <div><input type="date" name="date_de_naissance" id="" value="<?= $date_de_naissance ?>"></div>
                </div>
                <div>
                    <div><input type="submit" value="Mettre à jour"></div>
                </div>
            </form>
            <a href="index.php">Back</a>
        </body>
        </html>
        <?php
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
?>