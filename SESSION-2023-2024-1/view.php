<?php
session_start();
// Code de la première question
if(!isset($_SESSION["user"])) header("location:index.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <p>Cours enregistrés par <?= $_SESSION["user"]["name"] ?></p>
    <table>
        <thead>
            <th>Course Code</th>
            <th>Section</th>
            <th>Drop</th>
        </thead>
        <tbody>
        <?php
        require_once 'connection.php';
        $studentid = $_SESSION["user"]["studentid"];
        $query = "SELECT * FROM registration WHERE studentid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $studentid);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?= $row["course_code"] ?></td>
                <td><?= $row["course_section"] ?></td>
                <td><a href='delete.php?studentid=<?=$studentid?>&course_code=<?=$row["course_code"]?>&course_section=<?=$row["course_section"]?>'><img src='delete.png'/></a></td>
            </tr>
            <?php
        }
        ?>            
        </tbody>
    </table>
</body>
</html>