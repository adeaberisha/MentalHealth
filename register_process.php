<?php
include 'DatabaseConnection.php';

$dbConnection = new DatabaseConnection();
$conn = $dbConnection->startConnection();

if (!$conn) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $checkQuery = "SELECT * FROM users WHERE email = :email";
    $checkStatement = $conn->prepare($checkQuery);
    $checkStatement->bindParam(':email', $email);
    $checkStatement->execute();

    if ($checkStatement->rowCount() > 0) {
        echo "<script>alert('Email already exists!'); </script>";
    } else {
        // If email doesn't exist, proceed with the insertion
        $role = isset($_POST['role']) ? $_POST['role'] : 'user'; // Default role is 'user'
        
        $insertQuery = "INSERT INTO users (email, password, role) VALUES (:email, :password, :role)";
        $insertStatement = $conn->prepare($insertQuery);
        $insertStatement->bindParam(':email', $email);
        $insertStatement->bindParam(':password', $password);
        $insertStatement->bindParam(':role', $role);

        if ($insertStatement->execute()) {
            header("Location: Main.php");
            echo "<script>alert('User has been registered successfully!'); </script>";
            // header("Location: LoginForm.php");
            exit();
        } else {
            echo "<script>alert('Error!'); </script>";
        }
    }
}

$conn = null;  // Close the connection
 
?>
