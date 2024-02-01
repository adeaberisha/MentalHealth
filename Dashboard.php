<?php

include("navbar.php");
include ("userRepository.php");
include ("TherapistRepository.php");
include ("ProductRepository.php");

$user = new userRepository();
$therapists = new TherapistRepository();
$products = new ProductRepository();

$userId = $_SESSION['user_id'];
$user_therapists = $therapists->getTherapistsByUserIds($userId);

if (isset($_GET['action']) && $_GET['action'] === 'delete_therapist' && isset($_GET['therapist_id'])) {
    $therapistId = $_GET['therapist_id'];
    $therapists->deleteTherapist($therapistId);
}

if (isset($_GET['action']) && $_GET['action'] === 'delete_product' && isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $products->deleteProduct($productId);
}

/*============================*/








































?>