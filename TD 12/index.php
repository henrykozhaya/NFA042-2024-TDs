<?php require_once 'functions.php'; ?>
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
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération des données des étudiants
            $conn = db_connect();
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
                    echo "<td align='center'><a href='edit_etudiant.php?id=".$row["id"]."''><img width='16' src='img/edit.png'></td>";
                    echo "<td align='center'><a href='delete_etudiant.php?id=".$row["id"]."'><img width='16' src='img/delete.png'></td>";
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
