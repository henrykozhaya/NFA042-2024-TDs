<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if
    (
        isset($_POST["studentid"]) && !empty($_POST["studentid"])
        &&
        isset($_POST["pass"]) && !empty($_POST["pass"])
    )
    {
        extract($_POST);

        require_once "connection.php";

        $query = "SELECT * FROM students WHERE studentid = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $studentid);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($row["password"], $pass)){
                session_start();
                $_SESSION["user"]["studentid"] = $row["studentid"];
                $_SESSION["user"]["name"] = $row["name"];
                header("location:main.php");
            }
            else{
                header("location:index.php");
            }
        }
        else{
            header("location:index.php");
        }
    }
}
else{
    http_response_code(404);
    exit();
}