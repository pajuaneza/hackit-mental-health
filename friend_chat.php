<?php
include_once("class/ChatRoom.php");
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
else if (!isset($_GET['u']))
{
    header("location: ./");
}

$friend = new User();
$friend->loadData($_GET['u']);
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Chatting with <?php echo $friend->getUsername(); ?> - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <script>
            <?php
            if (isset($_GET['u']))
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
                         
                        xmlhttp.open("GET", "friend_chat_fetch.php?u={$friend->getId()}", true);
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
                         
                        xmlhttp.open("GET", "friend_chat_add.php?u={$friend->getId()}&m=" + document.getElementById("chat-box-add").value), true;
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
            <h2 class="text-overline">Community support</h2>
            <h1 class="text-h1" style="padding: 0;">
                Chatting with <?php echo $friend->getUsername(); ?>
            </h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section" id="chat-area">
                <div>
                    <span>Currently showing the last 50 messages</span>
                </div>

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
            </section>
        </main>
    </body>
</html>