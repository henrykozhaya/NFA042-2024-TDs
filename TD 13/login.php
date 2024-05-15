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

        // NOT SECURE - The password is saved as a clear text in the database
        // $query = "SELECT id, username, name FROM users WHERE username = '$username' AND password = '$password'";
        
        // MD5: More secure than clear text, but again not the best 
        // $query = "SELECT id, username, name FROM users WHERE username = '$username' AND `password` = MD5('$password')";
        
        $query = "SELECT id, username, name, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row["password"])){
            // Authentication Succeeded 
            $_SESSION["user"]["id"] = $row["id"];
            $_SESSION["user"]["name"] = $row["name"];
            $_SESSION["user"]["username"] = $row["username"];

            $stmt->close();
            $conn->close();

            header("location:index.php");
            }

        }
        die("Invalid Credentials");
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