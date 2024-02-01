<?php
include_once("navbar.php");
include_once("userRepository.php");
include_once("Assets/DatabaseConnection.php");
include_once("ProductRepository.php");

$dbConnection = DatabaseConnection::getInstance();
$conn = $dbConnection->startConnection();
$user = new userRepository ($conn);
$product = new ProductRepository ();

if ($_SESSION['user_authenticated']){

    $userId = $_SESSION['user_id'];

    if (isset($_GET['user_id'])){
        $userId = $_GET['user_id'];
    }

    $userEdit = $user->getUserById($userId);

    if (!$userEdit){
        echo "<p>User not found!</p>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="./Styles/Edit.css">
</head>
<body>
    <br>
    <div class="forms">
        <div class="form1">
            <h1 class="titulli">ADD YOUR PRODUCT</h1>
                <form method="post" class="forma" action="?action=add_product&user_id=<?= $userId ?>" enctype="multipart/form-data">
                    <label class="labels" for="name">Product Name:</label>
                        <input class="inputi" type="text" name="name" required>
                        <label class="labels" for="price">Price:</label>
                        <input class="inputi" type="number" name="price" step="0.01" required>
                        <label class="labels" for="category">Category:</label>
                    <select class="kategoria "name="category" required>
                        <option value="Original Hoodie">Original Hoodie</option>
                        <option value="Back Print Hoodie">Back Print Hoodie</option>
                        <option value="Front Print Hoodie">Front Print Hoodie</option>
                    </select>
                    <label class="labels" for="image">Image:</label>
                    <input class="labels" type="file" name="fileToUpload" id="fileToUpload" required>
                    <input class="submit" type="submit" name="add_product" value="Add Product">
                </form>
        </div>
   </div>
   <br>
</body>
</html>
<?php 

    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
            $image = $_FILES['fileToUpload']['name'];
    
            $destination = __DIR__ . '/Images/' . $image;

            echo "Destination Path: " . $destination;
            
            move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination);
    
            if ($product->addProduct($name, $price, $image, $userId, $category)) {
                echo "Product added successfully!";
            } else {
                echo "There was a problem adding your product!";
            }
        } else {
            echo "File upload failed!";
        }
    }

    if (isset($_POST['update_user'])) {
        $newEmail = $_POST['new_email'];
        $user->updateUser($userId, $newEmail);

        header("Location: Main.php");
        exit();

    } else {
        echo "<p>You are not logged in.</p>";
    }

    include_once("footer.php"); 
?>


    