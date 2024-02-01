<?php
session_start();

require_once 'DatabaseConnection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    $dbConnection = new DatabaseConnection();
    $conn = $dbConnection->startConnection();

    if ($conn) {

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $userData['password'])) {

                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['user_email'] = $userData['email'];
                $_SESSION['user_authenticated'] = true;
                $_SESSION['user_role'] = $userData['role'];

                if ($userData['role'] == 'admin') {
                    header("Location: Dashboard.php");
                } else {
                    header("Location: Main.php");
                }
                exit();
            } else {

                $_SESSION['error_message'] = "Invalid email or password!";
                header("Location: LoginForm.php");
                exit();
            }
    } else {

            $_SESSION['error_message'] = "Invalid email or password!";
            header("Location: LoginForm.php");
            exit();
        }

        $conn = null;
    } 
}


function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>