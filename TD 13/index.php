<?php
    require_once 'functions.php';
    $loginLink = "<a href='login.php'>Login</a>";
    $user_name = "";

    if(isset($_SESSION["user"])){
        // Logged In
        $loginLink = "<a href='logout.php'>Logout</a> - <a href='admin.php'>Admin</a>"; 
        $user_name = $_SESSION["user"]["name"];
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Welcome <?= $user_name ?> to our project</h2>
    <h3>This is a public area</h3>
    <h4><?= $loginLink ?></h4>
    <?php
    if(isset($_SESSION["user"])){
    ?>
    <div id="secureDiv">
        This is a secure section. Only logged in users should see it
    </div>
    <?php } ?>

</body>
</html>