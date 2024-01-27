<?php
require_once 'DatabaseConnection.php'; // Assuming you save your class in a file named DatabaseConnection.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    // Create an instance of the DatabaseConnection class
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->startConnection();

    if ($conn) {
        // Validate user credentials against the database
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // User exists in the database, allow login
            header("Location: Main.php"); // Redirect to a welcome page or dashboard
            exit();
        } else {
            // User does not exist in the database, display an error message
            echo "Invalid email or password. Please try again.";
        }

        // Close the database connection
        $conn = null;
    } else {
        echo "Error connecting to the database.";
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>