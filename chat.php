<?php
include_once("class/ChatRoom.php");
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}

if (isset($_GET['room']))
{
    $currentChatRoom = new ChatRoom();
    $currentChatRoom->loadData($_GET['room']);
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Group chat - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            <?php
            if (isset($currentChatRoom))
            {
                echo <<<CSS
                    #chat-room-select
                    {
                        display: none;
                    }
                     
                    .navbar, .header
                    {
                        background: {$currentChatRoom->getThemeColor()};
                    }
                     
                    .chat-bubble--me
                    {
                        background: {$currentChatRoom->getThemeColor()}
                    }
                CSS;
            }
            else
            {
                echo <<<CSS
                    #chat-area
                    {
                        display: none;
                    }
                CSS;
            }
            ?>
        </style>

        <script>
            <?php
            if (isset($currentChatRoom))
            {
                echo <<<JS
                    function refreshChatbox()
                    {
                        var chatBox = document.getElementById("chat-box-content");
                        var xmlhttp = new XMLHttpRequest();
                         
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                chatBox.innerHTML = this.responseText;
                            }
                        };
                         
                        xmlhttp.open("GET", "chat_fetch.php?room=" + {$currentChatRoom->getId()}, true);
                        xmlhttp.send();
                    }
                     
                    function addMessage()
                    {
                        var xmlhttp = new XMLHttpRequest();
                         
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                refreshChatbox();
                                document.getElementById("chat-box-content").scrollTop = document.getElementById("chat-box-content").scrollHeight;
                            }
                        };
                         
                        xmlhttp.open("GET", "chat_add.php?room=" + {$currentChatRoom->getId()} + "&q=" + document.getElementById("chat-box-add").value), true;
                        xmlhttp.send();
                         
                        document.getElementById("chat-box-add").value = "";
                    }
                    
                    refreshChatbox();
                    
                    setInterval(() => {
                        refreshChatbox();
                    }, 1500);
                JS;
            }
            ?>
        </script>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#community"><i class="fa fa-angle-double-left"></i> Social treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">
                <?php
                    echo isset($currentChatRoom)
                        ? "Group chat - {$currentChatRoom->getName()}"
                        : "Group chat";
                ?>
            </h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section" id="chat-room-select">
                <h2 class="text-h2">Choose a room</h2>

                <div class="home-shortcut-list">
                    <?php
                    foreach (ChatRoom::getAllChatRoom() as $chatRoom)
                    {
                        echo <<<HTML
                            <a class="home-shortcut-list__item" href="./chat.php?room={$chatRoom->getId()}" style="background: {$chatRoom->getThemeColor()}; width: 100%">
                                <div>{$chatRoom->getName()} <span style="font-weight: 600;">({$chatRoom->getTopic()})</span></div>
                                <div class="text-subtitle">{$chatRoom->getDescription()}</div>
                            </a>
                        HTML;
                    }
                    ?>
                </div>
            </section>

            <section class="main-content__section  main-content__section--small" id="chat-area">
                <a href="./chat.php">
                    <button class="button"><i class="fa fa-arrow-left"></i> Back to chat rooms</button>
                </a>

                <div>
                    <span class="text-overline">Your anonymous username is:</span> <?php echo $_SESSION['activeUser']->getUsername() ?><br />
                    <span>Currently showing the last 50 messages</span>
                </div>
                
                <?php
                if (isset($_GET['room']))
                {
                    echo <<<HTML
                        <div class="chat-box">
                            <div class="form">
                                <div class="chat-box-content" id="chat-box-content">
                                     
                                </div>
                                 
                                <div class="form__item form__item--inline">
                                    <div class="form__item">
                                        <textarea class="textbox textarea" type="text" id="chat-box-add" name="message" style="resize: none;"></textarea>
                                    </div>
                                     
                                    <button class="button" onclick="addMessage();">Add</button>
                                </div>
                            </div>
                        </div>
                    HTML;
                }
                ?>
            </section>
        </main>
    </body>
</html>