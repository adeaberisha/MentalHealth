<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Styles/Navbar.css">
</head>

<body>
    <div class="n">
        <nav>

            <div class="logo">
            <img src="Images/Logo-03-03.png" alt="Website Logo" style="width: 30px; height: 30px; margin-bottom: -5px;">
             NAVIGATING THE MIND MAZE
            </div>

            <div class="lista">
                <ul>
                    <li><a href="Main.php"><span>Home</span></a></li>
                    <li><a href="LearnMore.php"><span>Learn More</span></a></li>
                    <li><a href="Therapists.php"><span>Our Therapists</span></a></li>
                    <li><a href="Products.php"><span>Products</span></a></li>
                    <li><a href="ContactUs.php"><span>Contact Us</span></a></li>
                    <li><img src="Images/PersonLogo" alt="Person Logo" 
                    style="width: 25px; height: 25px; margin-bottom: -5px;">
                    <a href="LoginForm.php"><span>Log in</span></a>
                    </li>
                    
                </ul>
            </div>
 
            <div class="hamburger-menu" onclick="toggleMenu()">☰</div>

        </nav>
    </div>

    <script>

        function toggleMenu() {
            const lista = document.querySelector('.lista ul');
            lista.classList.toggle('show');
        }

        // Per mbylljen e menuse kur nje element i menuse preket
        document.querySelectorAll('.lista ul li a').forEach(item => {
        item.addEventListener('click', () => {
        const lista = document.querySelector('.lista ul');
        lista.classList.remove('show');
        });
        });

    </script>
    
</body>

</html>
