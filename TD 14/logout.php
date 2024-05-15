<?php
require_once 'functions.php';
session_destroy();
setcookie("t_user", "", time() - 1, "/");
header("location:index.php");