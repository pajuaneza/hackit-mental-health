<?php
include_once("./class/User.php");
include_once("./config/dbconfig.php");

session_start();

if (isset($_REQUEST['u']))
{
    $friend = new User();
    $friend->loadData($_REQUEST['u']);

    $stmt = $dbConnection->prepare(<<<SQL
        SELECT *
        FROM FriendMessage
        WHERE (
            SendingUserId = ?
            AND ReceivingUserId = ?
        )
        OR (
            SendingUserid = ?
            AND ReceivingUserId = ?
        )
        ORDER BY DateCreated ASC
        LIMIT 50;
SQL
    );

    $stmt->execute([
        $_SESSION['activeUser']->getId(), 
        $_REQUEST['u'], 
        
        $_REQUEST['u'], 
        $_SESSION['activeUser']->getId()
    ]);

    while ($row = $stmt->fetch())
    {
        $sender = new User();
        $sender->loadData($row['SendingUserId']);

        $class = $sender->getId() === $_SESSION['activeUser']->getId()
            ? "chat-bubble chat-bubble--me"
            : "chat-bubble";
        
        $dateCreated = new DateTime($row['DateCreated']);

        echo <<<HTML
            <div class="{$class}">
                <div>
                    <span class="text-overline">{$sender->getUsername()}</span>&ensp;
                </div>
                
                <div style="margin-top: 4px; font-weight: 600;">
                    {$row['Message']}
                    <div class="text-subtitle" style="font-size: 10px;">{$dateCreated->format("m/j/y h:i a")}</div>
                </div>
            </div>
        HTML;
    }
}