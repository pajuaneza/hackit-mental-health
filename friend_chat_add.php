<?php
include_once("./class/User.php");
include_once("./config/dbconfig.php");

session_start();

if (isset($_REQUEST['u']))
{
    $friend = new User();
    $friend->loadData($_REQUEST['u']);

    $stmt = $dbConnection->prepare(<<<SQL
        INSERT INTO FriendMessage (SendingUserId, ReceivingUserId, Message)
        VALUES (?, ?, ?)
SQL
    );

    $stmt->execute([
        $_SESSION['activeUser']->getId(), 
        $_REQUEST['u'],
        $_REQUEST['m']
    ]);

    while ($row = $stmt->fetch())
    {
        $sender = new User();
        $sender->loadData($row['SendingUserId']);

        $class = $sender === $_SESSION['activeUser']->getId()
            ? "chat-bubble chat-bubble--me"
            : "chat-bubble";
        
        $dateCreated = new DateTime($row['DateCreated']);
    }
}