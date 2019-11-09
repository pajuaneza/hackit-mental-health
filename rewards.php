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
        <title>Account rewards - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#myaccount"><i class="fa fa-angle-double-left"></i> My account</a></h2>
            <h1 class="text-h1" style="padding: 0;">Account rewards</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <ul class="bulleted-list">
                    <?php
                    $stmt = $dbConnection->prepare(<<<SQL
                        SELECT *
                        FROM RedeemedReward
                        LEFT JOIN Reward ON RedeemedReward.RewardId = Reward.RewardId
                        WHERE UserId = ?
                    SQL
                    );

                    $stmt->execute([$_SESSION['activeUser']->getId()]);

                    while ($row = $stmt->fetch())
                    {
                        $voucherCode = hash("sha256", "wellbeing-{$row['RedeemedRewardId']}-{$row['UserId']}-{row['RewardId']}");

                        echo <<<HTML
                                <li>
                                    {$row['Name']}<br />
                                    <span class="text-subtitle">Redeemed on {$row['DateRedeemed']}</span><br />
                                    <span style="font-size: 12px;">{$voucherCode}</span><br />
                                </li>
                        HTML;
                    }
                    ?>
                </ul>
            </section>
        </main>
    </body>
</html>