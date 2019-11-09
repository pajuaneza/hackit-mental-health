<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (isset($_GET['u']))
{
    $currentUser = new User();
    $currentUser->loadData($_GET['u']);
}
else
{
    $currentUser = $_SESSION['activeUser'];
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Mood tracker - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#dailyplanner"><i class="fa fa-angle-double-left"></i> My daily planner</a></h2>
            <h1 class="text-h1" style="padding: 0;">Mood tracking chart</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h2">
                    <?php
                    echo ($currentUser === $_SESSION['activeUser']
                        ? "Your "
                        : "{$currentUser->getFirstName()} {$currentUser->getLastName()}'s ")
                        . "warning signs";
                    ?>
                </h2>

                <?php
                foreach ($currentUser->getWarningSigns() as $warningSign)
                {
                    echo <<<HTML
                        <li>{$warningSign}</li>
                    HTML;
                }
                ?>
            </section>

            <section class="main-content__section">
                <?php
                if ($currentUser === $_SESSION['activeUser'])
                {
                    echo <<<HTML
                        <h2 class="text-h2">Safety plans</h2>
                         
                        <ul class="bulleted-list">
                            <li>
                                Learn useful information about mental health<br />
                                <a href="home.php#selfhelp"><button class="button"><i class="fa fa-leaf"></i> Go to lifestyle treatments</button></a>
                            </li>
                             
                            <li>
                                Connect with people<br />
                                <a href="friends.php"><button class="button"><i class="fa fa-user-friends"></i> Go to friends</button></a>
                                <a href="chat.php"><button class="button"><i class="fa fa-users"></i> Go to group chat</button></a>
                            </li>
                             
                            <li>
                                Share your experiences with close friends<br />
                                <a href="friends.php">
                                    <button class="button"><i class="fa fa-handshake"></i> Manage close friends</button>
                                </a>
                            </li>
                        </ul>
                    HTML;
                }
                else
                {
                    echo <<<HTML
                        <a href="./friends.php#friendlist"><button class="button"><i class="fa fa-arrow-left"></i> Return to friends list</button></a>
                        <a href="./friend_chat.php?u={$_GET['u']}"><button class="button"><i class="fa fa-comments"></i> Go to private chat</button></a>
                    HTML;
                }
                ?>
            </section>
        </main>
    </body>
</html>