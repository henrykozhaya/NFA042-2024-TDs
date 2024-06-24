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
    <h3>Bienvenue, <?= $_SESSION["user"]["name"] ?></h3>
    <p>Choisi....</p>
    <div>
        <a href="view.php"><img src="view.png"></a>
        <a href="register.php"><img src="register.png"></a>
    </div>
</body>
</html>