<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Journal - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <script>
            function refreshDiary()
            {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("diary-content").innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("GET", "diary_fetch.php?u=" + <?php echo $_SESSION['activeUser']->getId() ?>, true);
                xmlhttp.send();
            }

            function addDiaryEntry()
            {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        refreshDiary();
                    }
                };

                xmlhttp.open("GET", "diary_add.php?q=" + document.getElementById("diary-add-content").value, true);
                xmlhttp.send();
            }

            refreshDiary();
        </script>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./diary.php"><i class="fa fa-angle-double-left"></i> Activities</a></h2>
            <h1 class="text-h1" style="padding: 0;">Journal</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <form class="form" action="">
                    <div class="form__item">
                        <label class="textbox-label" for="entry">Journal entry</label>
                        <textarea class="textbox textarea" type="text" id="diary-add-content" name="entry"></textarea>
                    </div>

                    <div class="form__item form__item--inline">
                        <input class="button" type="submit" value="Add" onclick="addDiaryEntry();" />
                    </div>
                </form>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Previous entries</h2>
                <span id="diary-content"></span>
            </section>
        </main>
    </body>
</html>