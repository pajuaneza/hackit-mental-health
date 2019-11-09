<?php
include_once("./class/User.php");

session_start();

if (isset($_GET['id']))
{
    $stmt = $dbConnection->prepare(<<<SQL
        SELECT *
        FROM Reward
        WHERE RewardId = ?;
    SQL
    );

    $stmt->execute([$_GET['id']]);
    $data = $stmt->fetch();

    if ($_SESSION['activeUser']->deductPoints($data['PointCost'], "Redeemed reward {$data['Name']} (ID#{$_GET['id']})"))
    {
        $stmt = $dbConnection->prepare(<<<SQL
            INSERT INTO RedeemedReward (UserId, RewardId)
            VALUES (?, ?)
        SQL
        );

        $stmt->execute([$_SESSION['activeUser']->getId(), $_GET['id']]);

        header("location: ./redeem_points.php?success");
    }
    else
    {
        header("location: ./redeem_points.php?errorBalance");
    }
}
else
{
    header("location: ./");
}