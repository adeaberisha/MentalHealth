<?php 
include("DatabaseConnection.php");
include("navbar.php");
include_once("TherapistRepository.php");

$therapistRepository = new TherapistRepository();
$therapists = $therapistRepository->getAllTherapists();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Therapists</title>
    <link rel="stylesheet" href="./Styles/Therapists.css">

</head>
<body>
    <div class="foto1">
        <p style="font-size: xx-large;font-weight: bolder;color: cornsilk;">MEET OUR THERAPISTS</p>
    </div>

    <main>
        <div class="hyrja">
            <br>
            <h1 style="color: rgb(8, 82, 116);margin: 10px; margin-right: 2px;">Get to know us</h1>
            <p style="color: rgb(92, 90, 90);margin: 10px; margin-right: 2px;">Our therapists provide a supportive and creative space to explore the work of psychotherapy.
            We work with individuals,couples,families and adolescents.Start the healing process and get more information
            by choosing one of our therapists below...
            <br>
            </p>
        </div>
            
        

        <div class="therapists">
            <?php foreach ($therapists as $therapist):?>
                <div class="therapist">
                    <img src= "<?= $therapist['image_url']; ?> " alt="" class="img" >
                        <div class="info">
                            <ul class="informacione">
                                <li><b><?= $therapist['name'] ;?></b></li>
                                <li><b>Fee:</b> $ <?= $therapist['fee'];?> per session</li>
                                <li><b>Areas of Focus:</b><?= $therapist['areas_of_focus'];?></li>
                                <li><b>Specialized Skills:</b><?= $therapist['specialized_skills'];?></li>
                            </ul>
                            <button class="booknowbutton"><a href="LoginForm.html">Book now</a></button>
                        </div>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

</body>
</html>

<?php
include("footer.php");
?>