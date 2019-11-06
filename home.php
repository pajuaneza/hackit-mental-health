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

// Set color of header based on time period
if ($currentPeriod === "MORN")
{
    $currentPeriodColor = "var(--color-time--morning)";
}
else if ($currentPeriod === "AFTER")
{
    $currentPeriodColor = "var(--color-time--afternoon)";
}
else if ($currentPeriod === "EVE")
{
    $currentPeriodColor = "var(--color-time--evening)";
}
else
{
    $currentPeriodColor = "var(--color-primary-muted)";
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Home - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            .header
            {
                background: linear-gradient(to bottom, <?php echo $currentPeriodColor ?> 60%, var(--color-primary-muted));
            }

            .navbar
            {
                background-color: <?php echo $currentPeriodColor ?>;
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
                    <?php echo $_SESSION['activeUser']->getUsername() ?>
                </div>

                <div class="navbar__entry">
                    <a href="./logout.php">
                        <button class="button">Logout</button>
                    </a>
                </div>
            </div>
        </nav>

        <header class="header">
            <?php
            // TODO: Add name
            ?>
            <h1 class="text-h1" style="padding: 0;"><?php echo getGreeting(date("H")) . ", {$_SESSION['activeUser']->getUsername()}!"; ?></h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h2">Community support</h2>

                <div class="home-shortcut-list">
                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Find psychiatrists near me</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Join a group chat session</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Friends and networking</div>
                    </a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Progress tracking</h2>

                <div class="home-shortcut-list">
                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">My daily diary</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Mood tracker</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Monitoring statistics</div>
                    </a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Self-help</h2>

                <div class="home-shortcut-list">
                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Tips and advice</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Fun activities</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Videos and music</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Frequently asked questions</div>
                    </a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">My account</h2>

                <div class="home-shortcut-list">
                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Account settings</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">Redeem points</div>
                    </a>

                    <a href="javascript:void(0);">
                        <div class="home-shortcut-list__item">My achievements</div>
                    </a>
                </div>
            </section>
        </main>

        <script src="./scripts/install.js"></script>
    </body>
</html>