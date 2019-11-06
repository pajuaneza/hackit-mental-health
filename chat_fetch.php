<?php
include_once("./class/ChatRoom.php");
include_once("./class/User.php");

session_start();

if (isset($_REQUEST['room']))
{
    $currentChatRoom = new ChatRoom();
    $currentChatRoom->loadData($_REQUEST['room']);

    foreach ($currentChatRoom->getMessages() as $chatRoomMessage)
    {
        $sender = new User();
        $sender->loadData($chatRoomMessage->getUserId());

        $class = $chatRoomMessage->getUserId() === $_SESSION['activeUser']->getId()
            ? "chat-bubble chat-bubble--me"
            : "chat-bubble";

        echo <<<HTML
            <div class="{$class}">
                <div>
                    <span class="text-overline">{$sender->getUsername()}</span>&ensp;
                    <span class="text-subtitle">{$chatRoomMessage->getDateCreated()->format("F j, Y (h:i a)")}</span>
                </div>
                <div style="margin-top: 4px; font-weight: 600;">{$chatRoomMessage->getMessage(50)}</div>
            </div>
        HTML;
    }
}