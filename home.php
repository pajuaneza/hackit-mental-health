<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}

date_default_timezone_set('Asia/Singapore');

function getTimePeriod(int $time): string
{
    if ($time >= 6 && $time < 12)
    {
        return "MORN";
    }
    else if ($time >= 12 && $time < 18)
    {
        return "AFTER";
    }
    else if ($time >= 18 || $time < 6)
    {
        return "EVE";
    }
    else
    {
        throw new Exception("Invalid hour.");
    }
}

function getGreeting(int $time)
{
    if (getTimePeriod($time) === "MORN")
    {
        return "Marvelous morning";
    }
    else if (getTimePeriod($time) === "AFTER")
    {
        return "Amazing afternoon";
    }
    else if (getTimePeriod($time) === "EVE")
    {
        return "Elegant evening";
    }
    else
    {
        return "Good day";
    }
}

// Set current time period
$currentPeriod = getTimePeriod(date("H"));
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Home - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            :root
            {
                <?php
                    if ($currentPeriod === "MORN")
                    {
                        echo "--color-time: var(--color-time--morning)";
                    }
                    else if ($currentPeriod === "AFTER")
                    {
                        echo "--color-time: var(--color-time--afternoon)";
                    }
                    else if ($currentPeriod === "EVE")
                    {
                        echo "--color-time: var(--color-time--evening)";
                    }
                ?>
            }

            .header
            {
                background: linear-gradient(to bottom, var(--color-primary-muted) 60%, var(--color-time));
            }

            .navbar
            {
                background-color: var(--color-primary-muted);
            }
        </style>
    </head>

    <body>
        <nav class="navbar">
            <div class="navbar__left">
                <div class="navbar__entry text-h4">
                    <a href="./home.php"><?php echo APP_NAME ?></a>
                </div>
            </div>

            <div class="navbar__right">
                <div class="navbar__entry">
                    <?php echo "{$_SESSION['activeUser']->getFirstName()} {$_SESSION['activeUser']->getLastName()}" ?>
                </div>

                <div class="navbar__entry">
                    <a href="./logout.php">
                        <button class="button">Logout</button>
                    </a>
                </div>
            </div>
        </nav>

        <header class="header">
            <h1 class="text-h1" style="padding: 0;"><?php echo getGreeting(date("H")) . ", {$_SESSION['activeUser']->getFirstName()}!"; ?></h1>
            <h2 class="text-subtitle"><i class="fa fa-user" aria-hidden="true"></i> <?php echo "{$_SESSION['activeUser']->getUsername()}" ?></h2>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h2">Community support</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Find psychiatrists near me</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Join a group chat session</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Friends and networking</a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Progress tracking</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="javascript:void(0);">My daily diary</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Mood tracker</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Monitoring statistics</a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Self-help</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Tips and advice</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Fun activities</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Videos and music</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Frequently asked questions</a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">My account</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Account settings</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">Redeem points</a>
                    <a class="home-shortcut-list__item" href="javascript:void(0);">My achievements</a>
                </div>
            </section>
        </main>
    </body>
</html>