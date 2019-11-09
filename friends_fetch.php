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
                    <div class="home-shortcut-list__item">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-handshake"></i>
                        </div>
                        <div class="text-overline">Trusted</div>
                        {$friend->getUsername()}
                        <div class="text-subtitle">({$friend->getFirstName()} {$friend->getLastName()})</div>
                        <a href="friend_chat.php?u={$friend->getId()}"><button class="button"><i class="fa fa-comments"></i> Private chat</button></a>
                        <a href="friends_add_close.php?u={$friend->getId()}"><button class="button"><i class="fa fa-handshake"></i> Add to trusted</button></a>
                        <a href="mood.php?u={$friend->getId()}"><button class="button"><i class="fa fa-exclamation-triangle"></i> View warning signs</button></a>
                    </div>
                HTML;
            }
            else
            {
                echo <<<HTML
                    <div class="home-shortcut-list__item">
                        <div class="home-shortcut-list__item__icon">
                            <i class="fa fa-user-friends"></i>
                        </div>
                        <div class="text-overline">Mutual</div>
                        {$friend->getUsername()}
                        <a href="friend_chat.php?u={$friend->getId()}"><button class="button"><i class="fa fa-comments"></i> Private chat</button></a>
                        <a href="friends_add_close.php?u={$friend->getId()}"><button class="button"><i class="fa fa-handshake"></i> Add to trusted</button></a>
                    </div>
                HTML;
            }
        }
        else
        {
            echo <<<HTML
                <div class="home-shortcut-list__item">
                    <div class="home-shortcut-list__item__icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="text-overline">Friend</div>
                    {$friend->getUsername()}
                </div>
            HTML;
        }
    }
}