<?php
include_once("config/appconfig.php");

session_start();

if (isset($_SESSION['activeUser']))
{
    header("location: ./home.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title><?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            .main-content
            {
                margin: auto;
                background: linear-gradient(to bottom, var(--color-primary-muted), var(--color-primary-muted--dark));
            }

            .header
            {
                background: linear-gradient(to bottom, var(--color-accent-muted--light) 60%, var(--color-primary-muted));
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                min-height: 100vh;
                padding: 48px 32px;
            }

            .main-content__section
            {
                margin: auto;
            }

            .title
            {
                font-size: 32px;
                font-weight: 600;
                letter-spacing: 4px;
                text-align: center;
            }

            .subtitle
            {
                font-size: 16px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <header class="header">
            <span class="title text-heading"><?php echo APP_NAME ?></span>
            <span class="subtitle text-heading">Something something something something something</span>
            <div style="margin: 10px;">
                <a href="./login.php">
                    <button class="button button--cut-right">Log in</button>
                </a>

                <a href="./register.php">
                    <button class="button button--cut-left">Sign up</button>
                </a>
            </div>

            <div>
                <a class="text-link" href="#about">&#709; About <?php echo APP_NAME ?> &#709; </a>
            </div>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h1 class="text-h1">What is <?php echo APP_NAME ?>?</h1>

                <p>Many Cebuanos suffer from stress on a daily basis. Stress can become the root mental disorders such as anxiety, depression, personality disorders and more. Almost 50% of the people who die from suicide suffers from mental disorders.</p>

                <p>LOOSEN UP is an application that aids in mental health wellbeing. It is designed to reduce the stress that a person may feel through seeking help with their friends,  a therapist or by doing fun activities to relax.</p>

                <p>“In order for a person to be smart, they need to have a good mental health. Thus, we cannot achieve a smart city if we are not smart enough to handle stress.”</p>
            </section>
        </main>
    </body>
</html>