<?php require_once 'functions.php'; ?>
<?php
// Vérification de la méthode de requête
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id = cleanStringInput($_GET["id"]);
        $conn = db_connect();
        $stmt = $conn->prepare("DELETE FROM student WHERE id = ?");
        $stmt->bind_param("s", $id);
    
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
?>