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
        <title>Fun activities - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#selfhelp"><i class="fa fa-angle-double-left"></i> Lifestyle treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">Fun activities</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h3">Play a Video or Online Game</h2>
                <h2 class="text-h3">Watch a movie</h2>
                <h2 class="text-h3">Have a picnic in the park</h2>
                <h2 class="text-h3">Go swimming</h2>
                <h2 class="text-h3">Travel</h2>
                <h2 class="text-h3">Ride a bike</h2>
            </section>
        </main>
    </body>
</html>