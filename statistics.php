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

const CATEGORIES = array("Anxiety", "Irritability", "Anger", "Good");

const COLOR_SLIGHT = "#69f0ae";
const COLOR_MEDIUM = "#448aff";
const COLOR_SEVERE = "#ff5252";
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Schedule - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        
        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Mood category', 'Number of times', { role: 'style' }],
                    <?php
                    foreach (CATEGORIES as $category)
                    {
                        $stmt = $dbConnection->prepare(<<<SQL
                            SELECT *
                            FROM Schedule
                            LEFT JOIN Mood ON Schedule.Mood = Mood.MoodId
                            WHERE UserId = ?
                            AND Category = ?
                            AND Date = ?;
                        SQL
                        );
                
                        $stmt->execute([$_SESSION['activeUser']->getId(), $category, $selectedDate]);
                        $data = $stmt->rowcount();

                        if ($category !== "Good")
                        {
                            if ($data < 3)
                            {
                                $color = COLOR_SLIGHT;
                            }
                            else if ($data < 6)
                            {
                                $color = COLOR_MEDIUM;
                            }
                            else
                            {
                                $color = COLOR_SEVERE;
                            }
                        }
                        else
                        {
                            $color = COLOR_SLIGHT;
                        }

                        echo "['{$category}', {$data}, '{$color}'],";
                    }
                    ?>
                ]);

                var options = {
                    chart: {
                        title: 'Mood levels',
                        subtitle: 'for date <?php echo $selectedDate ?>',
                    },
                    hAxis: {
                        title: 'Mood levels',
                        format: 'h:mm a',
                        maxValue: 10,
                    },
                    vAxis: {
                        title: 'Number of times felt',
                        gridlines: {
                            count: 4,
                        },
                        viewWindow: {
                            min: 0, max: 8
                        },
                    },
                    legend: {
                        position: 'none',
                    },
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('chart'));
                chart.draw(data, options);
            }

            $(window).resize(function(){
                drawChart();
            });
        </script>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#dailyplanner"><i class="fa fa-angle-double-left"></i> My daily planner</a></h2>
            <h1 class="text-h1" style="padding: 0;">Mood Tracking Chart</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <div>
                    <input name="date" value="<?php echo $selectedDate ?>" class="textbox" type="date" required onchange="window.location='?d=' + this.value;" />
                </div>
            </section>

            <section class="main-content__section" style="min-height: 412px;">
                <div id="chart"></div>
                <div>
                    <a href="./schedule.php"><button class="button">Refer to daily activities</button"</a>
                </div>
            </section>

            <section class="main-content__section">
                <h2 class="text-subtitle">Legend</h2>
                <ul>
                    <li><span style="color: <?php echo COLOR_SLIGHT ?>">&#x2588;</span> Slight</li>
                    <li><span style="color: <?php echo COLOR_MEDIUM ?>">&#x2588;</span> Medium</li>
                    <li><span style="color: <?php echo COLOR_SEVERE ?>">&#x2588;</span> Severe</li>
                </ul>
            </section>
        </main>
    </body>
</html>