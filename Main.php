<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main</title>
  <link rel="stylesheet" href="Main.css">
  
</head>
<body>

    <div class="n">
        
        <nav>
            <div class="logo">
                <img src="Logo-03-03.png" alt="Website Logo" style="width: 30px; height: 30px; margin-bottom: -5px;">
                NAVIGATING THE MIND MAZE
            </div>

            <script>
                function redirectToPage(PageURL){
                    window.location.href = PageURL;
                }
            </script>

            <div class="lista">
                <ul>
                    <li><a href="Main.html"><span>Home</span></a></li>
                    <li><a href="LearnMore.html"><span>Learn More</span></a></li>
                    <li><a href="Therapists.html"><span>Our Therapists</span></a></li>
                    <li><a href="ContactUs.html"><span>Contact Us</span></a></li>
                    <li><img src="PersonLogo" alt="Person Logo" 
                        style="width: 25px; height: 25px; margin-bottom: -5px;">
                        <a href="LoginForm.html"><span>Log in</span></a>
                    </li>
                </ul>
            </div>

            <div class="hamburger-menu" onclick="toggleMenu()">☰</div>

        </nav>
    </div>

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
            <img src="image13.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>Dr.Aisha Khan</b></li>
                    <li><b>Areas of Focus:</b>LGBTQ+ Counseling</li>
                    <li><b>Specialized Skills:</b>Affirmative Therapy</li>
                </ul>
            </div>
        </div>
        <div class="therapist">
            <img src="image8.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>Dr.Samuel Foster</b></li>
                    <li><b>Areas of Focus:</b>Cultural Identity and Issues</li>
                    <li><b>Specialized Skills:</b>Diversity Awareness</li>
                </ul>
            </div>
        </div>
        <div class="therapist">
            <img src="image14.jpeg" alt="" class="img" >
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
        <button class="getbutton"><a href="Therapists.html">Our Therapists</a></button>
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
                    <img src="Books-1-02.jpg" alt="Image 1" class="slide">
                    <img src="Books-2-02.jpg" alt="Image 2" class="slide">
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
                <img src="R1.PNG" alt="R1">
            </div>

            <div class="second">
                <h2 style="color: #14945d">FEEL CONNECTED</h2>
                <img src="R2.PNG" alt="R2">
            </div>

            <div class="third">
                <h2 style="color: #56d2d4;">STAY FOCUSED</h2>
                <img src="R3.png" alt="R3">
            </div>

        </div>
            

        <div class="secondthree">

            <div class="first">
                <h2 style="color: #fa8ea3;">SHARPEN YOUR MIND</h2>
                <img src="R4.png" alt="R4">
            </div>

            <div class="second">
                <h2 style="color: #f5c055;">BE HEALTHIER</h2>
                <img src="R5.png" alt="R5">
            </div>

            <div class="third">
                <h2 style="color: #ee5645;">TAKE A BREAK</h2>
                <img src="R6.png" alt="R6">
            </div>
           
        </div>

    </div>

    <div class="bestsellers">
        <h2>SHOP OUR BEST SELLERS</h2>
    </div>
    <div class="merchendise">
        <div class="merch">
            <img src="merch5.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>Nick Portrait Project Hoodie</b></li>
                    <li><b>$80</b></li>
                </ul>
            </div>
        </div>
        <div class="merch">
            <img src="merch6.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>Original Happiness Hoodie</b></li>
                    <li><b>$70</b></li>
                </ul>
            </div>
        </div>
        <div class="merch">
            <img src="merch7.jpeg" alt="" class="img">
            <div class="info">
                <ul>
                    <li><b>"Not The Answer" Hoodie</b></li>
                    <li><b>$75</b></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="visit-bestsellers">
        <button class="getbutton"><a href="Products.html">SHOP OUR BEST SELLERS</a></button>
    </div>

    <div class="footer">
        <footer>
            <div class="container">

                <div class="tekst">
                    <h3 style="color: black;font-size: x-large;">NAVIGATING THE MIND MAZE</h3>
                    <p>Embark on a journey through the labyrinth of the mind with us at Navigating the Mind Maze. 
                        Your compass to mental well-being, offering insights, support, and resources to navigate the intricate paths
                        of mental health. 
                        Together, let's navigate the maze and discover the strength within.
                        Learn more about us <a href="ContactUs.html" style="color: rgb(64, 63, 63);">by clicking here</a>.
                    </p>

                </div>
                <p class="copyright" style="color: rgb(64, 63, 63);">Navigating The Mind Maze © 2018</p>

            </div>
        </footer>
    </div>

    <script>

        //SLIDERI I PARE
        let i = 0;
        let imgArray = ['slider5-02.jpg','slider2-02.jpg','slider3-02.jpg','slider4-02.jpg','slider1-02.jpg','slider6-02.jpg'];

       
        function changeImg(){
        let slideshowImg = document.getElementById('slideshow');
        slideshowImg.onload = function(){
        slideshowImg.height = 600; // height per fotot

        let screenWidth =  window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        slideshowImg.width = screenWidth; // width per fotot

        };

        slideshowImg.src = imgArray[i];
       
        }

        function nextImg() {
            if (i < imgArray.length - 1) {
                i++;
            } else {
                i = 0;
            }
            changeImg();
        }

        function prevImg() {
            if (i > 0) {
                i--;
            } else {
                i = imgArray.length - 1;
            }
            changeImg();
        }

        function startSlider() {
            setInterval(nextImg, 4000); //Ndryshoje fotografine cdo 4 sekonda
        }

        document.addEventListener("DOMContentLoaded", function() {
            changeImg(); //Tregoje fotografine e pare
            startSlider(); //Filloje sliderin automatik
        });

        window.addEventListener('resize',function(){
            changeImg();
        });

    </script>

  <script>
    /*SLIDER I DYTE (ME LIBRA)*/
    let currentIndex = 0;

    function changeSlide(direction) {
        const slides = document.querySelector('.slider');
        const totalSlides = document.querySelectorAll('.slide').length;

        currentIndex += direction;

        if (currentIndex < 0) {
            currentIndex = totalSlides - 1;
        } else if (currentIndex >= totalSlides) {
            currentIndex = 0;
        }

        const translateValue = -currentIndex * 100 + '%';
        slides.style.transform = 'translateX(' + translateValue + ')';

    }

    /*RESPONSIVITETI I NAVBAR*/
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