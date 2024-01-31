<?php
include 'userRepository.php';
include 'databaseConnection.php';

$user = new userRepository();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = isset($_POST['role']) ? $_POST['role'] : 'user'; // Default role is 'user'

    // Call the insertUser method for registration
    $user->insertUser($email,$password,$role);
}

?>