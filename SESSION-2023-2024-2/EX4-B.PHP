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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if
    (
        isset($_POST["num_article"]) && !empty($_POST["num_article"])
        &&
        isset($_POST["qte_commandee"]) && !empty($_POST["qte_commandee"])
    )
    {
        extract($_POST);
        $num_article = intval($num_article);
        $qte_commandee = intval($qte_commandee);

        $conn = db_connect();

        $query = "SELECT qte, prix FROM articles WHERE num = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $num_article);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = mysqli_fetch_assoc($result);

        if($row["qte"] >= $qte_commandee){
            $query = "INSERT INTO orders (article, qty, total_price, order_date) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($query);
            $total_price = $row["prix"]*$qte_commandee;
            $stmt->bind_param("iii", $num_article, $qte_commandee, $total_price);
            $stmt->execute();

            $query = "UPDATE articles SET qte = (qte - ?) WHERE num = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ii", $qte_commandee, $num_article);
            $stmt->execute();            
        }
        else{
            die("Quantity in stock....");
        }
    }
    else{
        die("Erro uploading file");
    }
}
else{
    http_response_code(404);
    exit();
}