<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Tips and advice - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#selfhelp"><i class="fa fa-angle-double-left"></i> Lifestyle treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">Tips and advice</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h3">Take a Walk</h2>
                <h2 class="text-h3">Meditate</h2>
                <h2 class="text-h3">Spend Time With Your Pet</h2>
                <h2 class="text-h3">Get More Sleep</h2>
                <h2 class="text-h3">Keep a positive attitude</h2>
                <h2 class="text-h3">Exercise</h2>
                <h2 class="text-h3">Eat healthy</h2>
                <h2 class="text-h3">Make time for hobbies, interests, and relaxation</h2>
                <h2 class="text-h3">Learn to love yourself</h2>
                <h2 class="text-h3">Start caring for yourself</h2>
                <h2 class="text-h3">Chew Gum</h2>
                <h2 class="text-h3">Listen to Soothing Music</h2>
                <h2 class="text-h3">Enjoy Aromatherapy</h2>
                <h2 class="text-h3">Don’t be too hard on yourself</h2>
            </section>
        </main>
    </body>
</html>