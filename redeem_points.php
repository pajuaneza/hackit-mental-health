<?php
include_once("class/User.php");
include_once("config/appconfig.php");
include_once("config/dbconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Redeem points - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#myaccount"><i class="fa fa-angle-double-left"></i> My account</a></h2>
            <h1 class="text-h1" style="padding: 0;">Redeem points</h1>
        </header>

        <main class="main-content" id="about">
            <?php
            if (isset($_GET['success']))
            {
                echo <<<HTML
                    <section class="main-content__section">
                        <div class="banner banner--success">
                            <div>Reward redeemed successfully</div>
                            <div>
                                <a href="./rewards.php">
                                    <button class="button">Go to account rewards</button>
                                </a>
                            </div>
                        </div>
                    </section>
                HTML;
            }
            else if (isset($_GET['errorBalance']))
            {
                echo <<<HTML
                    <section class="main-content__section">
                        <div class="banner banner--error">You do not have enough points to redeem this reward</div>
                    </section>
                HTML;
            }
            ?>
            
            <section class="main-content__section">
                <div style="background-color: var(--color-accent-muted--light); display: inline-block; padding: 32px; text-align: center; margin: auto; border-radius: 64px 0; border: 3px solid var(--color-accent-muted--dark); width: 256px;">
                    <div><i class="fa fa-diamond" aria-hidden="true" style="font-size: 1.5rem; margin: 8px;"></i></div>

                    <div>
                        <div style="font-size: 3rem"><?php echo $_SESSION['activeUser']->getPoints(); ?></div>
                        points
                    </div>
                </div>

                <div>
                    <h3 class="text-h3">How do I earn points?</h3>

                    <div>
                        <div>
                            <p>You can earn points just by using the app! Some ways to earn include:
                            <ul class="bulleted-list">
                                <li>Sending messages in the <a href="./chat.php">chat rooms</a></li>
                                <li>Writing in your <a href="./journal.php" class="text-link">journal</a></li>
                                <li>Filling in your <a href="./schedule.php" class="text-link">scheduler</a></li>
                            </ul></p>
                            <p>Points you earn can be used to avail of vouchers from our partner companies. Note that you can only earn a limited amount of points per day, so the more you use the app, and the more often that you log in, the more points you earn.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Rewards</h2>
                <?php
                $stmt = $dbConnection->prepare(<<<SQL
                    SELECT *
                    FROM Reward
                    ORDER BY Name ASC;
                SQL
                );
        
                $stmt->execute();

                while ($row = $stmt->fetch())
                {
                    echo <<<HTML
                        <div>
                            <h3 class="text-h4">{$row['Name']}</h3>
                            <p>{$row['Description']}</p>
                            <p class="text-overline">{$row['PointCost']} points</p>
                            <a href="./redeem_points_send.php?id={$row['RewardId']}">
                                <button class="button">Redeem now</button>
                            </a>
                        </div>
                    HTML;
                }
                ?>
            </section>
        </main>
    </body>
</html>