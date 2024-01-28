<?php
require_once 'DatabaseConnection.php'; 

//Kontrollojme a eshte bere submit forma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    //Krijojme instance te klases DatabaseConnection
    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->startConnection();

    if ($conn) {
        //Validojme kredencialet e perdoruesit
        $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Nese perdoruesi ekziston ne databaze, lejojme login 
            header("Location: Main.php"); // Redirect ne main page
            exit();
        } else {
            // Useri nuk ekziston ne databaze, kemi error message
            echo "<script>alert('Invalid email or password!');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'LoginForm.php'; }, 1000);</script>";
        }

        //Mbyllim lidhjen me databaze
        $conn = null;
    } else {
        echo "Error connecting to the database.";
    }
}

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>