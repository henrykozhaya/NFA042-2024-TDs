<?php
session_start();
if(!isset($_SESSION["user"])) header("location:index.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if
    (
        isset($_POST['code_cours']) && !empty($_POST['code_cours'])
        &&
        isset($_POST['course_section']) && !empty($_POST['course_section'])
    )
    {
        extract($_POST);
        $studentid = $_SESSION["user"]["studentid"];
        require_once 'connection.php';
        $query = "INSERT INTO registration (studentid, code_cours, course_section) VALUES (?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iss', $studentid, $code_cours, $course_section);
        $stmt->execute();
        header('location:view.php');
    }
}