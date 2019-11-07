<?php
include_once("class/User.php");
include_once("config/appconfig.php");
include_once("config/dbconfig.php");

session_start();

if (isset($_GET['d']))
{
    $selectedDate = $_GET['d'];
}
else
{
    $selectedDate = date("Y-m-d");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Schedule - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./diary.php"><i class="fa fa-angle-double-left"></i> Activities</a></h2>
            <h1 class="text-h1" style="padding: 0;">Schedule</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section" style="overflow-x: auto; border: 2px solid var(--color-primary);">
                <form action="schedule_add.php" method="POST">
                    <table border=1 cellpadding=8 style="margin: auto;">
                        <tr>
                            <td colspan=4 align=center><input name="date" value="<?php echo $selectedDate ?>" class="textbox" type="date" required onchange="window.location='./schedule.php?d=' + this.value;" /></td>
                        </tr>

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
                            LEFT JOIN Mood ON Schedule.Mood = Mood.MoodId
                            WHERE UserId = ?
                            AND Date = ?
                            ORDER BY Time ASC;
    SQL
                        );
                
                        $stmt->execute([$_SESSION['activeUser']->getId(), $selectedDate]);

                        while ($row = $stmt->fetch())
                        {
                            $datetime = new DateTime($row['Time']);

                            echo <<<HTML
                                <tr>
                                    <td align=center>{$datetime->format("h:m a")}</td>
                                    <td align=center>{$row['PlannedActivity']}</td>
                                    <td align=center>{$row['ActualActivity']}</td>
                                    <td align=center>{$row['Name']}</td>
                                </tr>
    HTML;
                        }
                        ?>

                        <tr>
                            <td><input name="time" value="<?php echo date("H:i"); ?>" class="textbox" type="time" required /></td>
                            <td><input name="plannedActivity" class="textbox" type="text" /></td>
                            <td><input name="actualActivity" class="textbox" type="text" required /></td>
                            <td>
                                <select name="mood" class="textbox" required>
                                    <?php
                                        $stmt = $dbConnection->prepare(<<<SQL
                                            SELECT *
                                            FROM Mood
                                            ORDER BY Name ASC;
                                        SQL
                                        );
                                
                                        $stmt->execute();

                                        while ($row = $stmt->fetch())
                                        {
                                            echo "<option value={$row['MoodId']}>{$row['Name']}</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td colspan=5 align=center><input name="submit" class="button" type="submit" /></td>
                        </tr>
                    </table>
                </form>
            </section>
        </main>
    </body>
</html>