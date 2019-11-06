<?php
include_once("./class/ChatRoom.php");
include_once("./class/User.php");

session_start();

if (isset($_REQUEST['room']) && isset($_REQUEST['q']) && $_REQUEST['q'] != "")
{
    $currentChatRoom = new ChatRoom();
    $currentChatRoom->loadData($_REQUEST['room']);

    $chatMessage = new ChatRoomMessage();
    $chatMessage->setChatRoomId($_REQUEST['room']);
    $chatMessage->setUserId($_SESSION['activeUser']->getId());
    $chatMessage->setMessage($_REQUEST['q']);

    $chatMessage->saveData();
}