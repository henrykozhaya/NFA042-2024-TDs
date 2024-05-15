<?php
require_once 'functions.php';
if(!isset($_SESSION["user"])) header("location:login.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>This is an admin area</h3>
    <div><a href='index.php'>Home</a></div>
</body>
</html>