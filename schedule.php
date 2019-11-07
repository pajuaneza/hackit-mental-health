<?php
include_once("class/User.php");
include_once("config/appconfig.php");
include_once("config/dbconfig.php");

session_start();
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Login - <?php echo APP_NAME ?></title>

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
            <h2 class="text-overline">Progress tracking</h2>
            <h1 class="text-h1" style="padding: 0;">Schedule</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section" style="overflow-x: auto; border: 2px solid var(--color-primary);">
                <table border=1 cellpadding=8>
                    <tr>
                        <th>Time</th>
                        <th>Planned activity</th>
                        <th>Actual activity</th>
                        <th>How it felt</th>
                    </tr>

                    <?php
                    $stmt = $dbConnection->prepare(<<<SQL
                        SELECT *
                        FROM Schedule
                        WHERE UserId = ?;
SQL
                    );
            
                    $stmt->execute([$_SESSION['activeUser']->getId()]);

                    while ($row = $stmt->fetch())
                    {
                        $datetime = new DateTime($row['Time']);

                        echo <<<HTML
                            <tr>
                                <td align=center>{$datetime->format("h:m a")}</td>
                                <td align=center>{$row['PlannedActivity']}</td>
                                <td align=center>{$row['ActualActivity']}</td>
                                <td align=center>{$row['Mood']}</td>
                            </tr>
HTML;
                    }
                    ?>

                    <form action="schedule_add.php" method="POST">
                        <tr>
                            <td><input name="time" class="textbox" type="date" required /></td>
                            <td><input name="plannedActivity" class="textbox" type="text" required /></td>
                            <td><input name="actualActivity" class="textbox" type="text" required /></td>
                            <td><input name="mood" class="textbox" type="text" required /></td>
                        </tr>

                        <tr>
                            <td colspan=5 align=center><input name="submit" class="button" type="submit" /></td>
                        </tr>
                    </form>
                </table>
            </section>
        </main>
    </body>
</html>