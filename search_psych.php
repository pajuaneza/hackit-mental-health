<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Login - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline">Community support</h2>
            <h1 class="text-h1" style="padding: 0;">Find psychiatrists</h1>
        </header>

        <main class="main-content" id="about">
            
            </section>
        </main>
    </body>
</html>