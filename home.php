<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}

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
                background: linear-gradient(to bottom, var(--color-primary) 60%, var(--color-time));
            }

            .navbar
            {
                background-color: var(--color-primary);
            }

            .home-shortcut-list
                {
                    align-content: center;
                }
        </style>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h1 class="text-h1" style="padding: 0;"><?php echo getGreeting(date("H")) . ", {$_SESSION['activeUser']->getFirstName()}!"; ?></h1>
            <h2 class="text-subtitle">
                <span><i class="fa fa-user" aria-hidden="true"></i> <?php echo "{$_SESSION['activeUser']->getUsername()}" ?></span> &#x2022;
                <span><i class="fa fa-gem" aria-hidden="true"></i> <?php echo "Total points: {$_SESSION['activeUser']->getPoints()}" ?></span> &#x2022;
                <span><i class="fa fa-calendar-day" aria-hidden="true"></i> Points earned today: <?php echo "{$_SESSION['activeUser']->getPointsToday()} / " . DAILY_POINT_LIMIT ?></span>
            </h2>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section" id="dailyplanner">
                <h2 class="text-h2">My daily planner</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="./diary.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        Activities
                    </a>

                    <a class="home-shortcut-list__item" href="./mood.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-meh"></i>
                        </div>
                        Mood tracker
                    </a>

                    <a class="home-shortcut-list__item" href="./statistics.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-chart-bar"></i>
                        </div>
                        Monitoring
                    </a>
                </div>
            </section>

            <section class="main-content__section" id="psych">
                <h2 class="text-h2">Psychological treatments</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="./search_psych.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-user-md"></i>
                        </div>
                        Find psychiatrists near me
                    </a>
                </div>
            </section>

            <section class="main-content__section" id="community">
                <h2 class="text-h2">Social treatments</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="./chat.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-users"></i>
                        </div>
                        Join chat room
                    </a>

                    <a class="home-shortcut-list__item" href="./friends.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-user-friends"></i>
                        </div>
                        Friends
                    </a>
                </div>
            </section>

            <section class="main-content__section" id="selfhelp">
                <h2 class="text-h2">Lifestyle treatments</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="./tips.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-comment-medical"></i>
                        </div>
                        Tips and advice
                    </a>

                    <a class="home-shortcut-list__item" href="./fun_activities.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-hiking"></i>
                        </div>
                        Fun activities
                    </a>

                    <a class="home-shortcut-list__item" href="./audiovisual.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-file-audio"></i>
                        </div>
                        Videos and music
                    </a>

                    <a class="home-shortcut-list__item" href="./faq.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        Frequently asked questions
                    </a>
                </div>
            </section>

            <section class="main-content__section" id="myaccount">
                <h2 class="text-h2">My account</h2>

                <div class="home-shortcut-list">
                    <a class="home-shortcut-list__item" href="./settings.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-user-cog"></i>
                        </div>
                        Account settings
                    </a>

                    <a class="home-shortcut-list__item" href="./redeem_points.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-gem"></i>
                        </div>
                        Redeem points
                    </a>

                    <a class="home-shortcut-list__item" href="./rewards.php">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        Check redeemed rewards
                    </a>
                </div>
            </section>
        </main>
    </body>
</html>