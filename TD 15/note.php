<?php
// Connexion à la base de données
$servername = "localhost";
$username = "note";
$password = "note123";
$dbname = "note";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Fonction pour obtenir les matières depuis la base de données
function getMatieres($conn) {
    $sql = "SELECT id, description FROM matiere";
    $result = $conn->query($sql);
    $matieres = [];
    while($row = $result->fetch_assoc()) {
        $matieres[] = $row;
    }
    return $matieres;
}

// Fonction pour obtenir les années depuis la base de données
function getAnnees($conn) {
    $sql = "SELECT annee FROM annee";
    $result = $conn->query($sql);
    $annees = [];
    while($row = $result->fetch_assoc()) {
        $annees[] = $row;
    }
    return $annees;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification et traitement du formulaire
    $matiereID = $_POST['matiere'];
    $annee = $_POST['annee'];
    $file = $_FILES['notes'];

    // Validation des entrées
    if (!$matiereID || !$annee || !$file) {
        echo "Tous les champs sont requis.";
        exit;
    }

    if ($file['type'] !== 'text/csv') {
        echo "Le fichier doit être au format CSV.";
        exit;
    }

    // Déplacement du fichier téléchargé
    $uploadDir = 'notes/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = "notes-{$matiereID}-{$annee}.csv";
    $filePath = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Lecture du fichier et insertion dans la base de données
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            fgetcsv($handle); // Sauter la première ligne (en-têtes)
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $eleveId = (int) $data[0];
                $note = (float) $data[1];

                // Validation des données
                if (!is_numeric($note) || $note < 0 || $note > 20) {
                    echo "Note invalide pour l'élève ID: $eleveId.";
                    continue; // Passer à la ligne suivante
                }

                $sql = "INSERT INTO note (note, annee, matiereID, eleveId) VALUES ('$note', '$annee', '$matiereID', '$eleveId')";
                if (!$conn->query($sql)) {
                    echo "Erreur lors de l'insertion des données pour l'élève ID: $eleveId.";
                }
            }
            fclose($handle);
            echo "Les données ont été insérées avec succès.";
        } else {
            echo "Impossible de lire le fichier.";
        }
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
} else {
    // Affichage du formulaire
    $matieres = getMatieres($conn);
    $annees = getAnnees($conn);
    $currentYear = date('Y');
    ?>

    <form action="note.php" method="post" enctype="multipart/form-data">
        <label for="matiere">Matière:</label>
        <select name="matiere" id="matiere">
            <?php foreach ($matieres as $matiere) { ?>
                <option value="<?php echo $matiere['id']; ?>"><?php echo $matiere['description']; ?></option>
            <?php } ?>
        </select><br>

        <label for="annee">Année:</label>
        <select name="annee" id="annee">
            <?php foreach ($annees as $annee) { ?>
                <option value="<?php echo $annee['annee']; ?>" <?php echo ($annee['annee'] == $currentYear) ? 'selected' : ''; ?>>
                    <?php echo $annee['annee']; ?>
                </option>
            <?php } ?>
        </select><br>

        <label for="notes">Fichier des notes (CSV):</label>
        <input type="file" name="notes" id="notes"><br>

        <input type="submit" value="Soumettre">
    </form>

    <?php
}

$conn->close();
?>
