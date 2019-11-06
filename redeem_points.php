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
        <title>Videos and music - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline">My account</h2>
            <h1 class="text-h1" style="padding: 0;">Redeem points</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <div style="background-color: var(--color-accent-muted--light); display: inline-block; padding: 32px; text-align: center; margin: auto; border-radius: 64px 0; border: 3px solid var(--color-accent-muted--dark);">
                    <div><i class="fa fa-diamond" aria-hidden="true" style="font-size: 1.5rem; margin: 8px;"></i></div>

                    <div>
                        <div style="font-size: 3rem"><?php echo $_SESSION['activeUser']->getPoints(); ?></div>
                        points
                    </div>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Nothing here... yet!</h2>
                <p>We're working to bring you a lot of exciting rewards for being an awesome member. Stay tuned!</p>
            </section>
        </main>
    </body>
</html>