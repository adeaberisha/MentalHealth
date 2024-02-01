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

if ($_SESSION['user_role'] === 'admin') {
    if (isset($_GET['action']) && isset($_GET['user_id'])) {
        $action = $_GET['action'];
        $userId = $_GET['user_id'];

        if ($action === 'edit') {
            $userToEdit = $user->getUserById($userId);
            ?>
            <h1 class="titulli">Edit User</h1>
            <form method="post" action="?action=update&user_id=<?= $userId ?>">
                <label for="new_email">New Email:</label>
                <input type="email" name="new_email" value="<?= $userToEdit["email"] ?>">
                <input type="submit" name="update_user" value="Update User">
            </form>
            <?php
        } elseif ($action === 'delete') {
            $user->deleteUser($userId);
        }
    }

    if (isset($_POST['update_user'])) {
        $newEmail = $_POST['new_email'];
        $user->updateUser($userId,$newEmail,$newPassword);
    }

    $allUsers = $user->getAllUsers();

    echo '<h1 class="titulli">User Dashboard</h1>';
    foreach ($allUsers as $currentUser): ?>
        <div class="permbajtja-dashboard">
            <p class="permbajtja">
                <?= $currentUser["email"] ?>
            </p>
            <a href="?action=edit&user_id=<?= $currentUser['id'] ?>">Edit</a>
            <a href="?action=delete&user_id=<?= $currentUser['id'] ?>">Delete</a>
        </div>
        <hr class="hr" 
        <?php
    endforeach;
}
?>








































?>