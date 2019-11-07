<?php
include_once("./config/dbconfig.php");
include_once("./class/User.php");

session_start();

if (isset($_SESSION['activeUser'], $_REQUEST['u']))
{
    $stmt = $dbConnection->prepare(<<<SQL
        SELECT *
        FROM User
        WHERE Username = ?;
SQL
    );

    $stmt->execute([$_REQUEST['u']]);

    if ($stmt->rowcount() > 0)
    {
        $row = $stmt->fetch();

        // Username exists
        $friend = new User();
        $friend->loadData($row['UserId']);

        if (!$_SESSION['activeUser']->isFriend($friend))
        {
            $stmt = $dbConnection->prepare(<<<SQL
                INSERT INTO UserFriend (UserId, FriendId)
                VALUES (?, ?)
SQL
            );

            $stmt->execute([$_SESSION['activeUser']->getId(), $friend->getId()]);

            echo "{$friend->getUsername()} added as a friend!";
        }
        else
        {
            echo "You are already friends with {$friend->getUsername()}";
        }
    }
    else
    {
        // Username doesn't exist
        echo "That user does not exist";
    }
}