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
    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
            z-index: 1000; 
        }

        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001; 
        }

        #editProductModal {
            display: none;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1002; 
        }

        #editProductForm label,
        #editProductForm input,
        #editProductForm select,
        #editProductForm textarea {
            display: block;
            margin-bottom: 10px;
            width: 400px;
            height: 35px;
        }

        #editTherapistForm {
            padding: 40px;
        }

        #editTherapistModal {
            display: none;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1002; 
        }

        #editTherapistForm label,
        #editTherapistForm input,
        #editTherapistForm select,
        #editTherapistForm textarea {
            display: block;
            margin-bottom: 10px;
            width: 400px;
            height: 35px;
        }

        #editTherapistForm {
            padding: 40px;
        }
    </style>
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

    if (isset($_POST['update_product'])) {
        $id = $_POST['pid'];
        $name = $_POST['editProductName'];
        $price = $_POST['editPrice'];
        $category = $_POST['editCategory'];
        $image_path = $_FILES['editImageFile']['name'];
        $imageUrl = 'Images/' . $image_path;
    
    
        $products->updateProduct($id, $name, $price, $category, $imageUrl);
        header("Location: dashboard.php");
        exit();
    
    }

    if (isset($_POST['update_therapist'])) {
        $therapist_id = $_POST['therapist_id'];
        $name = $_POST['therapistName'];
        $fee = $_POST['fee'];
        $areasOfFocus = $_POST['areasOfFocus'];
        $specializedSkills = $_POST['specializedSkills'];
        $image_path = $_FILES['imageFile']['name'];
        $imageUrl = 'Images/' . $image_path;
    
    
        $therapists->updateTherapist($therapist_id, $name, $fee, $areasOfFocus,$specializedSkills,$imageUrl);
        header("Location: dashboard.php");
        exit();
    
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

                        <button onclick="openModal(
                            <?= $product['id'] ?>,
                            '<?= $product['name'] ?>',
                            <?= $product['price'] ?>,
                            '<?= $product['category'] ?>',
                            '<?= $product['image_path'] ?>'
                            )" class="editimi">Edit
                        </button>

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
                            <button onclick="openTherapistModal(
                            <?= $therapist['therapist_id'] ?>,
                            '<?= $therapist['name'] ?>',
                            <?= $therapist['fee'] ?>,
                            '<?= $therapist['areas_of_focus'] ?>',
                            '<?= $therapist['specialized_skills'] ?>',
                            '<?= $therapist['image_url'] ?>'
                            )" class="editimi">Edit</button>
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
<div class="overlay"></div>
<div id="editProductModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()"><i class="fa fa-close" style="font-size:24px;color:white"></i></span>
        <form id="editProductForm" action="?action=update_product&product_id=<?= $product['id'] ?>" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name="pid" id="editProductId">
            <label for="editProductName">Product Name:</label>
            <input type="text" name="editProductName" id="editProductName">
            <label for="editPrice">Price:</label>
            <input type="text" name="editPrice" id="editPrice">
            <label class="labels" for="category">Category:</label>
            <select class="kategoria " id="editCategory" name="editCategory" required>
                <option value="Original Hoodie">Original Hoodie</option>
                <option value="Back Print Hoodie">Back Print Hoodie</option>
                <option value="Front Print Hoodie">Front Print Hoodie</option>
            </select>

            <label class="labels" for="editImage">Image:</label>
            <input class="labels" type="file" name="editImageFile" id="fileToUpload">

            <input type="submit" name="update_product" value="Update Product">
        </form>
    </div>
</div>

<div class="overlay"></div>
<div id="editTherapistModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeTherapistModal()"><i class="fa fa-close" style="font-size:24px;color:white"></i></span>
        <form id="editTherapistForm" action="?action=update_therapist&therapist_id=<?= $therapist['therapist_id'] ?>" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name="therapist_id" id="editTherapistId">
            <label for="editTherapistName">Therapist Name:</label>
            <input type="text" name="therapistName" id="editTherapistName">
            <label for="editFee">Fee:</label>
            <input type="text" name="fee" id="editFee">
            <label class="labels" for="areasOfFocus">Areas of Focus:</label>
            <select class="areasOfFocus" id="editAreasOfFocus" name="areasOfFocus" required>
                <option value="Relationship counseling">Relationship counseling</option>
                <option value="Anxiety Management">Anxiety Management</option>
                <option value="Trauma Recovery">Trauma Recovery</option>
                <option value="Family Dynamics">Family Dynamics</option>
                <option value="Addiction Recovery">Addiction Recovery</option>
                <option value="Neurodevelopmental Disorders">Neurodevelopmental Disorders</option>
                <option value="Cultural Identity and Issues">Cultural Identity and Issues</option>
                <option value="Adolescent Counseling">Adolescent Counseling</option>
                <option value="ADHD">ADHD</option>
                <option value="Anger Management">Anger Management</option>
                <option value="Eating Disorders">Eating Disorders</option>
                <option value="Insomnia,sleep disorder">Insomnia,sleep disorder</option>
                <option value="Self-esteem">Self-esteem</option>
                <option value="Grief and Loss">Grief and Loss</option>
                <option value="Career Counseling">Career Counseling</option>
            </select>
            <label class="labels" for="specializedSkills">Specialized Skills:</label>
            <select class="specializedSkills" id="editSpecializedSkills" name="specializedSkills" required>
                <option value="Couples Therapy">Couples Therapy</option>
                <option value="Mindfulness Techniques">Mindfulness Techniques</option>
                <option value="Trauma-Informed">Trauma-Informed</option>
                <option value="Conflict Resolution">Conflict Resolution</option>
                <option value="Abuse Counseling">Abuse Counseling</option>
                <option value="Social Skills Training">Affirmative Therapy</option>
                <option value="Diversity Awareness">Diversity Awareness</option>
                <option value="Parent-child therapy">Parent-child therapy</option>
                <option value="ADHD Coaching">ADHD Coaching</option>
                <option value="Anger related disorders">Anger related disorders</option>
                <option value="Nutritional Counseling">Nutritional Counseling</option>
                <option value="Cognitive Behavioral">Cognitive Behavioral</option>
                <option value="Acceptance and Comitment Therapy">Acceptance and Comitment Therapy</option>
                <option value="Bereavement Counseling and Patience Therapy">Bereavement Counseling and Patience Therapy</option>
                <option value="Goal Setting and Self-Confidence">Goal Setting and Self-Confidence</option>
            </select>
            <label class="labels" for="editImage">Image:</label>
            <input class="labels" type="file" name="imageFile" id="fileToUpload">

            <input type="submit" name="update_therapist" value="Update Therapist">
        </form>
    </div>
</div>
<?php

?>
<script>
        function openModal(id, name, price, category, imageUrl) {
            document.getElementById('editProductId').value = id;
            document.getElementById('editProductName').value = name;
            document.getElementById('editPrice').value = price;
            document.getElementById('editCategory').value = category;

            document.getElementById('editProductModal').style.display = 'flex';
            document.querySelector('.overlay').style.display = 'block';
        }

        function openTherapistModal(id, name, fee, areasOfFocus, specializedSkills, imageUrl) {

            document.getElementById('editTherapistId').value = id;
            document.getElementById('editTherapistName').value = name;
            document.getElementById('editFee').value = fee;
            document.getElementById('editAreasOfFocus').value = areasOfFocus;
            document.getElementById('editSpecializedSkills').value = specializedSkills;


            document.getElementById('editTherapistModal').style.display = 'flex';
            document.querySelector('.overlay').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editProductModal').style.display = 'none';

        function closeTherapistModal() {
            document.getElementById('editTherapistModal').style.display = 'none';
        }
    
        document.querySelector('.overlay').style.display = 'none';
        }

</script> 