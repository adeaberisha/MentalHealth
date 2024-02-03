<?php
include_once("navbar.php");
include_once("userRepository.php");
include_once("Assets/DatabaseConnection.php");
include_once("ProductRepository.php");
include_once("TherapistRepository.php");

$dbConnection = DatabaseConnection::getInstance();
$conn = $dbConnection->startConnection();
$user = new userRepository ($conn);
$product = new ProductRepository ();
$therapist = new TherapistRepository ();

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
        <h1 class="titulli">EDIT PROFILE</h1>
        <form method="post" class="forma" action="?action=update&id=<?= $userId ?>">
            <label for="new_email" class="labels">New Email:</label>
            <input type="email" class="inputi" name="new_email" value="<?= $userEdit["email"] ?>">
            <label for="new_password" class="labels">New Password:</label>
            <input type="password" class="inputi" name="new_password">
            <input type="submit" class="submit" name="update_user" value="Update Profile">
        </form>
    </div>
    <br>
    <div class="forms">
        <div class="form2">
            <h1 class="titulli">ADD A PRODUCT</h1>
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

<body>
    <br>
<?php
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){
    ?>
    <div class="forms">
        <div class="form3">
            <h1 class="titulli">ADD A THERAPIST</h1>
                <form method="post" class="forma" action="?action=add_therapist&user_id=<?= $userId ?>" enctype="multipart/form-data">
                    <label class="labels" for="name">Therapist Name:</label>
                        <input class="inputi" type="text" name="name" required>
                    <label class="labels" for="fee">Fee:</label>
                        <input class="inputi" type="number" name="fee" step="0.01" required>
                    <label class="labels" for="areasOfFocus">Areas of Focus:</label>
                        <select class="kategoria "name="areasOfFocus" required>
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
                        <select class="kategoria "name="specializedSkills" required>
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
                    <label class="labels" for="image">Image:</label>
                    <input class="labels" type="file" name="fileToUpload" id="fileToUpload" required>
                    <input class="submit" type="submit" name="add_therapist" value="Add Therapist">
                </form>
        </div>
   </div>
<?php
}
?> 
<br>
</body>
</html>

<?php 

    if(isset($_POST['add_product'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0){
            $image = $_FILES['fileToUpload']['name'];
            $destination = __DIR__ . '/Images/' . $image;

            if(file_exists($destination)){
                echo "<script>alert('File already exists. Choose a different file or name.');</script>";
            } 
            else{
                if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination)){
                    try{
                    $imageUrl = 'Images/' . $image;

                        if($product->addProduct($name, $price, $imageUrl, $userId, $category)){
                            echo "<script>alert('Product added sucessfully!');</script>";
                        } 
                        else{
                            echo "<script>alert('There was a problem adding your product!');</script>";
                        }
                    } catch(Exception $e){
                    echo "An error occurred: " . $e->getMessage();
                    }
                } 
                else{
                echo "<script>alert('File upload failed!');</script>";
                }
            }
        }
    }


    if(isset($_POST['add_therapist'])){

        //per mos me pas undefined index notices, perdorim isset
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $fee = isset($_POST['fee']) ? $_POST['fee'] : '';
        $areas_of_focus = isset($_POST['areasOfFocus']) ? $_POST['areasOfFocus'] : '';
        $specialized_skills = isset($_POST['specializedSkills']) ? $_POST['specializedSkills'] : '';

        if(isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === 0) {
            $image = $_FILES['fileToUpload']['name'];
            $destination = __DIR__ . '/Images/' . $image;
    
            if(file_exists($destination)){
                echo "<script>alert('File already exists. Choose a different file or name.');</script>";
            } 
            else{
                if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination)){
                    try {
                        $imagePath = 'Images/' . $image;
    
                        if($therapist->addTherapists($name, $fee, $userId, $areas_of_focus, $specialized_skills, $imagePath)) {
                            echo "<script>alert('Therapist added sucessfully!');</script>";
                        }else{
                            echo "<script>alert('There was a problem adding your therapist!');</script>";
                        }
                    }catch(Exception $e){
                        echo "An error occurred: " . $e->getMessage();
                    }
                }
                else{
                    echo "<script>alert('File upload failed.');</script>";
                }
            }
        } 
    }



    if (isset($_POST['update_user'])) {
        $newEmail = isset($_POST['new_email']) ? $_POST['new_email'] : '';
    
        if (!empty($newEmail)) {
            $result = $user->updateUser($userId, $newEmail);
    
            if($result){
                echo "<p>Email updated successfully.</p>";
            }
            else{
                echo "<p>Failed to update email.</p>";
            }
        }
        else{
            echo "<p>You are not logged in.</p>";
        }
    }
?>


    