<?php
session_start();
if(!isset($_SESSION["user"])) header("location:index.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="main.php">Acceuil</a>
    <hr>
    <p>Liste des cours disponibles</p>
    <ul>
    <?php
    require_once 'connection.php';
    $query = "SELECT * FROM cours";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <li><?= $row["code_cours"] ?>-<?= $row["section"] ?></li>
        <?php
    }
    ?>
    </ul>
    <hr>
    <form action="registercourse.php">
        <p>Entrez les données pour le cours auquel vous souhaitez vous inscrire:</p>
        <input type="text" placeholder="Course Code" name="course_code">
        <br>
        <input type="text" placeholder="Course Section" name="course_section">
        <br>
        <input type="submit" value="Entregistrer Cours">
    </form>
</body>
</html>