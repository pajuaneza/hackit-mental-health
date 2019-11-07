<?php
include_once("./config/dbconfig.php");
include_once("./class/User.php");

session_start();

if (isset($_GET['u']))
{
    $friend = new User();
    $friend->loadData($_GET['u']);

    if ($_SESSION['activeUser']->isMutualFriend($friend))
    {
        $stmt = $dbConnection->prepare(<<<SQL
            UPDATE UserFriend
            SET CloseFriend = TRUE
            WHERE UserId = ?
            AND FriendId = ?;
SQL
        );

        $stmt->execute([$_SESSION['activeUser']->getId(), $_REQUEST['u']]);
    }
}

header("location: ./friends.php");