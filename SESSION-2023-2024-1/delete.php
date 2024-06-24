<?php
session_start();
if(!isset($_SESSION["user"])) header("location:index.php");
if
(
    isset($_GET['studentid']) && !empty($_GET['studentid'])
    &&
    isset($_GET['code_cours']) && !empty($_GET['code_cours'])
    &&
    isset($_GET['course_section']) && !empty($_GET['course_section'])
)
{
    extract($_GET);
    require_once 'connection.php';
    $query = "DELETE FROM registration WHERE studentid = ? and course_code = ? and course_section = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('iss', $studentid, $code_cours, $course_section);
    $stmt->execute();
    header('location:view.php');
}