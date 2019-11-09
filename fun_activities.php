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
                <p>Video games get a bad rap, but studies have shown that playing video games actually does have health benefits—both for the brain and the body. Plus, it's just fun when you get that 5th straight win in a row while chatting along and laughing with your friends.</p>

                <h2 class="text-h3">Watch a movie</h2>
                <p>Movies are great at revitalizing yourself and for relaxation after a stressful day. Turn on the TV or drive down to your local cinema.</p>

                <h2 class="text-h3">Have a picnic in the park</h2>
                <p>Spending time outdoors among the trees and taking in the fresh air can be really great for both your physical and mental health.</p>

                <h2 class="text-h3">Go swimming</h2>
                <p>Swimming is fun and relaxing, and gives you a lot of exercise.<p>

                <h2 class="text-h3">Travel</h2>
                <p>Sometimes, you just need a vacation to break away from the grind and reset yourself. There is always something for you to explore and discover, including these <a target="_blank" href="https://www.detourista.com/guide/philippines-best-places/" class="text-link"><i class="fa fa-link"></i> places in the Philippines</a>.

                <h2 class="text-h3">Ride a bike</h2>
                <p>Riding a bike is great for exercising, helps you lower your carbon footprint, and is fun.</p>
            </section>
        </main>
    </body>
</html>