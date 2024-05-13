<?php
require_once 'functions.php';
if(isset($_SESSION["user"])) header("location:index.php");

$error = [];
if($_SERVER["REQUEST_METHOD"] === 'POST'){
    if
    (
        isset($_POST["username"]) && !empty($_POST["username"])
        && 
        isset($_POST["password"]) && !empty($_POST["password"])
    )
    {
        extract($_POST);
        $username = cleanStringInput($username);
        $password = cleanStringInput($password);
        $conn = db_connect();

        $query = "SELECT id, username, name FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        
        if($result->num_rows == 0){
            // Authentication Failed
            // $error[] = "Invalid Credentials";
            die("Invalid Credentials");
        }
        else{
            // Authentication Succeeded ($result->num_rows = 1)
            $row = mysqli_fetch_assoc($result);
            
            $_SESSION["user"]["id"] = $row["id"];
            $_SESSION["user"]["name"] = $row["name"];
            $_SESSION["user"]["username"] = $row["username"];
            header("location:index.php");
        }

    }
}
else if($_SERVER["REQUEST_METHOD"] === 'GET'){
?>
<body>
    <h2>Connexion</h2>
    <form method="POST" action="login.php">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" name="login" value="Se connecter">
    </form>
</body>
<?php
}
else{
    http_response_code(404);
    die();
} 