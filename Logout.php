<?php
session_start();

include("userRepository.php");
include("Database Connection.php");
$dbConnection = new DatabaseConnection();
$conn = $dbConnection->startConnection();

$user = new userRepository($conn);

$user->logout();

header("Location: Main.php");
exit();
?>