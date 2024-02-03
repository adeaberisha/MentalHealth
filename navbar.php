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
             <span>NAVIGATING THE MIND MAZE</span>
            </div>

            <div class="lista">
            <div class="hamburger-menu" onclick="toggleMenu()">☰</div>
                <ul>
                    <li><a href="Main.php">Home</a></li>
                    <li><a href="LearnMore.php">Learn More</a></li>
                    <li><a href="Therapists.php">Our Therapists</a></li>
                    <li><a href="Products.php">Products</a></li>
                    <li><a href="ContactUs.php">Contact Us</a></li>

                    <?php
                    
                    if (isset($_SESSION['user_authenticated']) && $_SESSION['user_authenticated']) {
                        echo '<li><a href="Dashboard.php">Dashboard</a></li>';
                        echo '<li><a href="Logout.php">Logout</a></li>';
                        echo'<li>';
                        echo '<img src="Images/PersonLogo" alt="Person Logo" style="width: 25px; height: 25px; margin-bottom: -5px;">';
                        echo '<a href="Edit.php"><i class="fa fa-user"></i>' . $_SESSION['user_email'] . '</a>';
                        echo '</li>';
                    } else {
                        echo '<li>';
                        echo '<img src="Images/PersonLogo" alt="Person Logo" style="width: 25px; height: 25px; margin-bottom: -5px;">';
                        echo '<a href="LoginForm.php">Log in</a>';
                        echo '</li>';
                    }
                    
                    ?>
                    
                </ul>
            </div>

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
