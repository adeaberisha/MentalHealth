<?php

include("navbar.php");
include ("userRepository.php");
include ("TherapistRepository.php");
include ("ProductRepository.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Styles/Dashboard.css">
</head>
<body>
    <?php
    $user = new userRepository();
    $therapists = new TherapistRepository();
    $products = new ProductRepository();
    
    $userId = $_SESSION['user_id'];
    $user_therapists = $therapists->getTherapistsByUserIds($userId);
    $user_products = $products->getProductsByUserId($userId);
    
    if (isset($_GET['action']) && $_GET['action'] === 'delete_therapist' && isset($_GET['therapist_id'])) {
        $therapistId = $_GET['therapist_id'];
        $therapists->deleteTherapist($therapistId);
    }
    
    if (isset($_GET['action']) && $_GET['action'] === 'delete_product' && isset($_GET['product_id'])) {
        $productId = $_GET['product_id'];
        $products->deleteProduct($productId);
    }
    
    if ($_SESSION['user_role'] === 'admin') {
        if (isset($_GET['action']) && isset($_GET['user_id'])) {
            $action = $_GET['action'];
            $userId = $_GET['user_id'];
    
            if ($action === 'edit') {
                $userToEdit = $user->getUserById($userId);
                ?>
                <h1 class="titulli">Edit User</h1>
                <form method="post" action="?action=update&user_id=<?= $userId ?>" class="forma">
                    <label for="new_email">New Email:</label>
                    <input type="email" name="new_email" value="<?= $userToEdit["email"] ?>">
                    <input type="text" name="new_role" value="<?= $userToEdit["role"] ?>">
                    <input type="submit" name="update_user" value="Update User">
                </form>
                <?php
            } elseif ($action === 'delete') {
                $user->deleteUser($userId);
            }
        }
    
        if (isset($_POST['update_user'])) {
            $newEmail = $_POST['new_email'];
            $newRole = $_POST['new_role'];
            $user->updateUser($userId,$newEmail,$newRole);
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
            <!-- <hr> -->
            <?php
        endforeach;
    }
    ?>


<h1 class="titulli">My products</h1>
    <div class="merchendise">
        <?php if (!empty($user_products)): ?>
            <?php foreach ($user_products as $product): ?>
                <div class="merch">
                    <img src="<?= $product['image_path'];?>" alt="" class="img" >
                        <div class="info">
                            <ul>
                                <li><b><?= $product['name'];?></b></li>
                                <li><b><?= $product['price'];?></b></li>
                            </ul>
                        </div>
                

                    <div class="buttons">
                        <a href="?action=delete_product&product_id=<?= $product['id'] ?>" class="fshirja" >
                            Delete
                        </a>
                        <a href="Editi.php?product_id=<?= $product['id'] ?>" class="editimi">
                            Edit
                        </a>
                        <a href="Products.php?product_id=<?= $product['id'] ?>" class="shiko">
                            View
                        </a>
                    </div>
                    <p>Added on:
                        <?= $product['dateofaddition'] ?>
                    </p>
                    <p>Added by:
                        <?= $user->getUserById($product['addedbyuser'])['email'] ?>
                    </p>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No products added. <a href="Edit.php">Add one</a>.</p>
        <?php endif; ?>
    </div>

    <!-- ================================================================================= -->
    <?php if ($_SESSION['user_role'] === 'admin'):?>
        <h1 class="titulli">My therapists</h1>
        <div class="therapists">
            <?php if (!empty($user_therapists)): ?>
                <?php foreach ($user_therapists as $therapist): ?>
                    <div class="therapist">
                        <img src="<?= $therapist['image_url'];?>" alt="" class="img" >
                        <div class="info">
                            <ul class="informacione">
                                <li><b><?= $therapist['name'] ;?></b></li>
                                <li><b>Fee:</b> $ <?= $therapist['fee'];?> per session</li>
                                <li><b>Areas of Focus:</b><?= $therapist['areas_of_focus'];?></li>
                                <li><b>Specialized Skills:</b><?= $therapist['specialized_skills'];?></li>
                            </ul>
                        </div>

                        <div class="buttons">
                            <a href="?action=delete_therapist&therapist_id=<?= $therapist['therapist_id'] ?>" class="fshirja">
                                Delete
                            </a>
                            <a href="Edit.php?therapist_id=<?= $therapist['therapist_id'] ?>" class="editimi">
                                Edit
                            </a>
                            <a href="Therapists.php?therapist_id=<?= $therapist['therapist_id'] ?>" class="shiko">
                                View
                            </a>
                        </div>

                        <p>Added on: <?= $therapist['dateofaddition'] ?></p>
                        <p>Added by: <?= $user->getUserById($therapist['addedbyuser'])['email'] ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No therapists added. <a href="Edit.php">Add one</a>.</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</body>
</html>