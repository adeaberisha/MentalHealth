<?php 
include("Assets/DatabaseConnection.php");
include("navbar.php");

include_once("ProductRepository.php");

$productRepository = new ProductRepository();
$products = $productRepository->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./Styles/Products.css">
</head>
<body>
    <main>
        <div class="hyrja">
            <div class="merchendise">
                <?php foreach ($products as $product):?> 
                    <div class="merch">
                        <img src="<?= $product['image_path'];?>" alt="" class="img" >
                        <div class="info">
                            <ul>
                                <li><b><?= $product['name'];?></b></li>
                                <li><b><?= $product['price'];?></b></li>
                            </ul>
                            <button class="getbutton"><a href="ContactUs.php">Get Yours</a></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>
</html>
<?php
include("footer.php");
?>