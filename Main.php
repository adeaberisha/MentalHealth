<?php 
include("DatabaseConnection.php");
include("navbar.php");

include_once("ProductRepository.php");

$productRepository = new ProductRepository();
// $threeProducts = $productRepository->getThreeProducts();
$productIds = [5,6,7];
$products = $productRepository->getProductsByIds($productIds)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health</title>
    <link rel="stylesheet" href="./Styles/Main.css">
    

<body>
    <div id="kontenti">
        <header>
            <h2></h2>
            <img id="slideshow">
        </header>
    </div>
    <br>
    <main class="maini">
        <br>
            <br>
            <div class="permbajtja">
                 <div class="majtas">
                    <p class="p1 "><b>Holistic Healing Hub:</b></p>
                    <p>We're not just here for the symptoms; we're here for the whole you. 
                        Navigating the Mind Maze provides a holistic approach to mental wellness, addressing mind, body, and spirit.</p>
                </div>
                <div class="qender1">
                    <p class="p2 "><b>Actionable Advice:</b></p>
                    <p>Tired of vague suggestions? Our website is packed with actionable recommendations to help you kick anxiety, ADHD, and depression to the curb. 
                        Practical tips, exercises, and resources - consider them your mental health toolkit</p>
                </div>
                <div class="qender2">
                    <p class="p3 "><b>Community Corner:</b></p>
                    <p>Because no hero embarks on a quest alone! Join our community of fellow mental health adventurers.
                         Share stories, swap strategies, and lift each other up on your journey to well-being.</p>
                </div>
                <div class="djathtas">
                    <p class="p4 "><b>Expert Guides:</b></p>
                    <p>Our team of mental health wizards (aka experts) curates the latest research,
                         trends, and techniques to keep you informed and empowered.</p>
                </div>
                <br>
                
            </div>
            <div class="fundi">
                <p>So, buckle up, fellow explorer! Your mental health adventure awaits at Navigating the Mind Maze.
                 Together, let's turn the quest for well-being into the epic saga it was meant to be!</p>
            </div>
            <br>
    </main>

    <div class="therapy">
        <h2>FEEL FREE TO TALK WITH OUR THERAPISTS</h2>
        <p class="txt">Welcome to our growing team of dedicated therapists! At Navigating The Mind Maze, we are thrilled to introduce 
            our newest members who bring a wealth of expertise and passion for mental health and well-being.</p>
    </div>
    <div class="therapists">
        <div class="therapist">
            <img src="Images/image13.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>Dr.Aisha Khan</b></li>
                    <li><b>Areas of Focus:</b>LGBTQ+ Counseling</li>
                    <li><b>Specialized Skills:</b>Affirmative Therapy</li>
                </ul>
            </div>
        </div>
        <div class="therapist">
            <img src="Images/image8.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>Dr.Samuel Foster</b></li>
                    <li><b>Areas of Focus:</b>Cultural Identity and Issues</li>
                    <li><b>Specialized Skills:</b>Diversity Awareness</li>
                </ul>
            </div>
        </div>
        <div class="therapist">
            <img src="Images/image14.jpeg" alt="" class="img" >
            <div class="info">
                <ul>
                    <li><b>Dr.Lily Nguyen</b></li>
                    <li><b>Areas of Focus:</b>Adolescent counseling</li>
                    <li><b>Specialized Skills:</b>Parent-child therapy</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="visit-therapy">
        <button class="getbutton"><a href="Therapists.php">Our Therapists</a></button>
    </div>

    <div class="title-container" id="recs">
        <h1>We've curated a collection of books just for you.</h1>
        <div class="paragraphs">
            <div>Delve into these resources to enhance your well-being and discover new perspectives on mental health.</div>
            <div>Your journey to a healthier mind starts here.</div>
            <div>Happy reading!</div>
        </div>
    </div>
    
    <div class="main-container">
        <div class="slider-container">
            <button class="prev-button" onclick="changeSlide(-1)"></button>
                <div class="slider">
                    <img src="Images/Books-1-02.jpg" alt="Image 1" class="slide">
                    <img src="Images/Books-2-02.jpg" alt="Image 2" class="slide">
                </div>
            <button class="next-button" onclick="changeSlide(1)"></button>
        </div>
    </div>
    <br>

    <div class="routine">

        <div class="teksti">
            <h1>TRY THIS ROUTINE</h1>
            <h2>IF YOU WANT TO...</h1>
        </div>

        <div class="firstthree">

            <div class="first">
                <h2 style="color: #708ecc;">BUILD CONFIDENCE</h2>
                <img src="Images/R1.PNG" alt="R1">
            </div>

            <div class="second">
                <h2 style="color: #14945d">FEEL CONNECTED</h2>
                <img src="Images/R2.PNG" alt="R2">
            </div>

            <div class="third">
                <h2 style="color: #56d2d4;">STAY FOCUSED</h2>
                <img src="Images/R3.png" alt="R3">
            </div>

        </div>
            

        <div class="secondthree">

            <div class="first">
                <h2 style="color: #fa8ea3;">SHARPEN YOUR MIND</h2>
                <img src="Images/R4.png" alt="R4">
            </div>

            <div class="second">
                <h2 style="color: #f5c055;">BE HEALTHIER</h2>
                <img src="Images/R5.png" alt="R5">
            </div>

            <div class="third">
                <h2 style="color: #ee5645;">TAKE A BREAK</h2>
                <img src="Images/R6.png" alt="R6">
            </div>
           
        </div>

    </div>

    <div class="bestsellers">
        <h2>SHOP OUR BEST SELLERS</h2>
    </div>
    <div class="merchendise">
        <?php foreach($products as $product):?>
            <div class="merch">
                <img src="<?= $product['image_path']?>" alt="" class="img">
                <div class="info">
                    <ul>
                        <li><b><?= $product['name']?></b></li>
                        <li><b><?= $product['price']?></b></li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="visit-bestsellers">
        <button class="getbutton"><a href="Products.php">SHOP OUR BEST SELLERS</a></button>
    </div>

</body>
</html>
<?php
include("footer.php");
?>