<?php
include_once("./class/User.php");

session_start();

if (isset($_REQUEST['u']))
{
    foreach ($_SESSION['activeUser']->getFriendList($_REQUEST['q']) as $friend)
    {
        if ($_SESSION['activeUser']->isMutualFriend($friend))
        {
            if ($friend->isCloseFriend($_SESSION['activeUser']))
            {
                echo <<<HTML
                    <div>{$friend->getUsername()} ({$friend->getFirstName()} {$friend->getLastName()}) [<i class="fa fa-handshake"></i> Trusted] 
                    <a href="friends_add_close.php?u={$friend->getId()}"><button class="button">Add as close friend</button></a>
                    <a href="mood.php?u={$friend->getId()}"><button class="button">View warning signs</button></a></div>
                HTML;
            }
            else
            {
                echo <<<HTML
                    <div>{$friend->getUsername()} ({$friend->getFirstName()} {$friend->getLastName()}) [<i class="fa fa-handshake"></i> Mutual] <a href="friends_add_close.php?u={$friend->getId()}"><button class="button">Add as close friend</button></a></div>
                HTML;
            }
        }
        else
        {
            echo <<<HTML
                <div>{$friend->getUsername()}</div>
            HTML;
        }
    }
}