<?php
include_once("class/User.php");
include_once("class/Psychiatrist.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Find psychiatrists - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            html, body
            {
                max-height: 100vh;
                overflow: hidden;
            }

            .header
            {
                padding-top: 12px;
            }

            #map {
                height: 100%;
            }
        </style>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS-lGKUMmn26ASQbPqAKEetmMur4Tt82M&callback=initMap" async defer></script>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#psych"><i class="fa fa-angle-double-left"></i> Psychological treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">Find psychiatrists</h1>
        </header>

        <main id="map">
            
        </main>

        <script>
            var currentLat = 10.3229572, currentLon = 123.953861;

            navigator.geolocation.getCurrentPosition(function(position) {
                currentLat = position.coords.latitude;
                currentLon = position.coords.longitude;
            });

            var map;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: currentLat, lng: currentLon},
                    zoom: 14,
                    gestureHandling: 'greedy',
                });

                var infowindow = new google.maps.InfoWindow();

                <?php
                    $stmt = $dbConnection->prepare(<<<SQL
                        SELECT *
                        FROM Psychiatrist;
                    SQL
                    );
            
                    $stmt->execute();

                    while ($row = $stmt->fetch())
                    {
                        $psych = new Psychiatrist();
                        $psych->loadData($row['PsychiatristId']);
                        
                        $starRating = $psych->getAverageRating() != null
                            ?'<i class="fa fa-star"></i>' . $psych->getAverageRating()
                            : "No ratings";

                        $address = nl2br($psych->getAddress());
                        $address = str_replace(array("\n", "\r"), '', $address;

                        echo <<<JS
                            var marker = new google.maps.Marker({position: {lat: {$psych->getLatitude()}, lng: {$psych->getLongitude()}}, map: map});
                             
                            google.maps.event.addListener(marker, 'click', function() {
                                infowindow.close();
                                infowindow.setContent(
                                    '<div class="text-h4">{$psych->getName()}</div>' +
                                    '<div>' + {$address} + '</div>' +
                                    '<div class="text-overline">{$starRating}</div>' +
                                    '<div><a href="./psych.php?id={$psych->getId()}"><button class="button"><i class="fa fa-info-circle"></i> More info</button></a></div>'
                                );
                                infowindow.open(map, this);
                            });
                        JS;
                    }
                ?>
            }
        </script>
    </body>
</html>