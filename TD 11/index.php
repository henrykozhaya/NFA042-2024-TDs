<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
</head>
<body>
    <h3>Ajouter de nouveaux enregistrements</h3>
    <form action="create_etudiant.php" method="POST">
        <div style="margin-bottom:10px;">
            <div>Nom</div>
            <div><input type="text" name="nom" id=""></div>
        </div>
        <div style="margin-bottom:10px;">
            <div>Email</div>
            <div><input type="text" name="email" id=""></div>
        </div>
        <div style="margin-bottom:10px;">
            <div>Date de Naissance</div>
            <div><input type="date" name="date_de_naissance" id=""></div>
        </div>
        <div>
            <div><input type="submit" value="Ajouter un nouvel étudiant"></div>
        </div>
    </form>

    <h3>Informations des étudiants</h3>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date de Naissance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connexion à la base de données
            $servername = "localhost";
            $username = "nfa042_user";
            $password = "nfa042_pass";
            $dbname = "nfa042_db";
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("La connexion a échoué : " . $conn->connect_error);
            }

            // Récupération des données des étudiants
            $sql = "SELECT * FROM student";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Affichage des données
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["date_de_naissance"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucun étudiant trouvé</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
