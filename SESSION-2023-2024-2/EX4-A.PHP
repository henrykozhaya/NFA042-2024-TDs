<?php
function db_connect(){
    $conn = null;
    // Connexion à la base de données
    $servername = "localhost";
    $username = "nfa042_user";
    $password = "nfa042_pass";
    $dbname = "nfa042_db";
    try{
        $conn = new mysqli($servername, $username, $password, $dbname);
    }
    catch(Exception $e){
        die(str($e->getMessage()));
    }
    finally{
        if(!$conn) die("MySQL Connection Error ");
        return $conn;
    }
}

$query = "SELECT * FROM articles";
$conn = db_connect();
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

?>
<table>
    <thead>
        <th>Image Article</th>
        <th>Num Article</th>
        <th>Nom Article</th>
        <th>Quantité en stock</th>
        <th>Prix</th>
        <th>Editer</th>
        <th>Supprimer</th>
    </thead>
    <tbody>
        <?php
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <tr>
            <td><img src='<?= $row["img_src"] ?>'></td>
            <td><?= $row["num"] ?></td>
            <td><?= $row["nom"] ?></td>
            <td><?= $row["qte"] ?></td>
            <td><?= $row["prix"] ?></td>
            <td><a href='editer_article.php?num=<?= $row["num"] ?>'>Editer</a></td>
            <td><a href='supprimer_article.php?num=<?= $row["num"] ?>'>Supprimer</a></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>