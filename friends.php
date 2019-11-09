<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Friends - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <script>
            function refreshFriendList()
            {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("friends-list").innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("GET", "friends_fetch.php?u=<?php echo $_SESSION['activeUser']->getId() ?>&q=" + document.getElementById("friends-filter").value, true);
                xmlhttp.send();
            }

            function addFriend()
            {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        window.alert(this.responseText);
                        refreshFriendList();
                    }
                };

                xmlhttp.open("GET", "friends_add.php?u=" + document.getElementById("friends-add-user").value, true);
                xmlhttp.send();
            }
        </script>

        <style>
            .home-shortcut-list
            {
                align-items: stretch;
            }

            .home-shortcut-list__item
            {
                height: fit-content;
                width: 250px;
            }

            .home-shortcut-list__item:hover
            {
                background-color: initial;
            }
        </style>
    </head>

    <body>
        <span id="output"></span>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#psych"><i class="fa fa-angle-double-left"></i> Social treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">Friends</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h2">Add friend</h2>
                
                <p>
                    Please add your closest friends here.
                    <ul class="bulleted-list">
                        <li>You can have up to 5 friends in your list at a time.</li>
                        <li>Added friends will receive notifications on your status as you use the app.</li>
                        <li>If both of you are mutual friends, you will be able to see each other's real names.</li>
                    </ul>
                </p>

                <div class="form">
                    <div class="form__item">
                        <label class="textbox-label" for="entry">Enter friend ID</label>

                        <div class="form__item form__item--inline">
                            <input class="textbox" type="text" id="friends-add-user" name="entry" placeholder="ex. <?php echo $_SESSION['activeUser']->getUsername() ?>" />
                            <input class="button" type="submit" value="Add" onclick="addFriend();" />
                        </div>
                    </div>
                </div>
            </section>

            <section class="main-content__section" id="friendlist">
                <h2 class="text-h2">Friends list</h2>

                <div class="form">
                    <div class="form__item">
                        <label class="textbox-label" for="entry">Filter friends</label>
                        <div class="form__item form__item--inline">
                            <input class="textbox" type="text" id="friends-filter" name="entry" onchange="refreshFriendList();" />
                        </div>
                    </div>
                </div>

                <span id="friends-list" class="home-shortcut-list"></span>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Close friends</h2>
                <p>If you add someone as a close friend, they can see your <a class="text-link" href="mood.php">warning signs</a> so that they will be informed. Only mutual friends can be added as close friends.</p>
                <ul id="close-friends-list" class="home-shortcut-list">
                    <?php
                    $stmt = $dbConnection->prepare(<<<SQL
                        SELECT *
                        FROM UserFriend
                        WHERE UserId = ?
                        AND CloseFriend = 1;
SQL
                    );

                    $stmt->execute([$_SESSION['activeUser']->getId()]);

                    while ($row = $stmt->fetch())
                    {
                        $friend = new User();
                        $friend->loadData($row['FriendId']);

                        echo <<<HTML
                            <div class="home-shortcut-list__item">
                                <div class="home-shortcut-list__item__icon">
                                    <i class="fa fa-handshake"></i>
                                </div>
                                {$friend->getUsername()}
                                <div class="text-subtitle">({$friend->getFirstName()} {$friend->getLastName()})</div>
                            </div>
                        HTML;
                    }
                    ?>
                </ul>
            </section>
        </main>

        <script>
            refreshFriendList();
        </script>
    </body>
</html>