<?php
include_once("./class/RecyclingCenter.php");
include_once("./class/User.php");
include_once("./config/appconfig.php");
include_once("./config/dbconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Recycle - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <nav class="navbar">
            <div class="navbar__left">
                <div class="navbar__entry text-h6">
                    <a href="./home.php"><?php echo APP_NAME ?></a>
                </div>
            </div>

            <div class="navbar__right">
                <div class="navbar__entry">
                    <?php echo $_SESSION['activeUser']->getUsername() ?>
                </div>

                <div class="navbar__entry">
                    <a href="./logout.php">
                        <button class="button">Logout</button>
                    </a>
                </div>
            </div>
        </nav>

        <header class="header">
            <h1 class="text-h1" style="padding: 0;">Recycle</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h1 class="text-h2">Choose material categories</h1>
                <p>Please choose the categories that you are trying to recycle. <a class="text-link" href="javascript:void(0);">Need help choosing?</a></p>

                <form class="form" action="" method="GET">
                    <?php
                    global $dbConnection;

                    $stmt = $dbConnection->prepare(<<<SQL
                        SELECT *
                        FROM MaterialCategory
                    SQL
                    );
            
                    $stmt->execute();
            
                    while ($row = $stmt->fetch())
                    {
                        echo <<<HTML
                            <div class="form__item form__item--inline">
                                <input type="checkbox" name="{$row['MaterialCategoryId']}" />
                                <label for="{$row['MaterialCategoryId']}">{$row['Name']}</label>
                            </div>
                        HTML;
                    }
                    ?>

                    <div class="form__item form__item--inline">
                        <input class="button button--cut-left" type="submit" name="submit" value="Search" />
                        <input type="checkbox" name="showAll" />
                        <label for="showAll">Show all locations</label>
                    </div>
                </form>
            </section>
            
            <?php
            if (isset($_GET['submit']))
            {
                $stmt = $dbConnection->prepare(<<<SQL
                    SELECT *
                    FROM MaterialCategory
                SQL
                );
        
                $stmt->execute();

                $selectedCategories = array();
        
                while ($row = $stmt->fetch())
                {
                    if (isset($_GET["{$row['MaterialCategoryId']}"]))
                    {
                        array_push($selectedCategories, $row['MaterialCategoryId']);
                    }
                }

                if (!empty($selectedCategories))
                {
                    $stmt = $dbConnection->prepare(<<<SQL
                        SELECT DISTINCT *
                        FROM RecyclingCenter
                    SQL
                    );

                    $stmt->execute();

                    $recyclingCenterAllList = array();
                    $recyclingCenterSomeList = array();
                    $recyclingCenterNoneList = array();

                    while ($row = $stmt->fetch())
                    {
                        $recyclingCenter = new RecyclingCenter();
                        $recyclingCenter->loadData($row['RecyclingCenterId']);

                        if ($recyclingCenter->canAcceptMaterialCategory($selectedCategories) == "ALL")
                        {
                            array_push($recyclingCenterAllList, $recyclingCenter);
                        }
                        else if ($recyclingCenter->canAcceptMaterialCategory($selectedCategories) == "SOME")
                        {
                            array_push($recyclingCenterSomeList, $recyclingCenter);
                        }
                        else
                        {
                            array_push($recyclingCenterNoneList, $recyclingCenter);
                        }
                    }

                    if (!empty($recyclingCenterAllList) || !empty($recyclingCenterSomeList) || isset($_GET['showAll']))
                    {
                        $markers = "";
                        $markerName = "A";

                        foreach ($recyclingCenterAllList as $recyclingCenter)
                        {
                            $markers .= "&markers=color:0x00c853%7Csize:mid%7Clabel:{$markerName}%7C{$recyclingCenter->getCoordinates()}";
                            $markerName = chr(ord($markerName) + 1);
                        }

                        foreach ($recyclingCenterSomeList as $recyclingCenter)
                        {
                            $markers .= "&markers=color:0xffd600%7Csize:mid%7Clabel:{$markerName}%7C{$recyclingCenter->getCoordinates()}";
                            $markerName = chr(ord($markerName) + 1);
                        }

                        if (isset($_GET['showAll']))
                        {
                            foreach ($recyclingCenterNoneList as $recyclingCenter)
                            {
                                $markers .= "&markers=color:0xd50000%7Csize:mid%7Clabel:{$markerName}%7C{$recyclingCenter->getCoordinates()}";
                                $markerName = chr(ord($markerName) + 1);
                            }
                        }

                        echo <<<HTML
                            <section class="main-content__section">
                                <h2 class="text-h2">Available recycling centers</h2>
                                <img
                                    src="https://maps.googleapis.com/maps/api/staticmap?
                                        &size=450x300
                                        &scale=2
                                        &maptype=roadmap
                                        {$markers}
                                        &key=AIzaSyCLjFL_FGxqdKRDkALhE4xkyVmh6HXAHIk"
                                    style="max-width: 100%;"
                                />
                                <div><span style="color: #00c853;">&#x272a;</span> This location accepts all of your recyclables</span>
                                <div><span style="color: #ffd600;">&#x272a;</span> This location accepts some of your recyclables</span>
                                <div><span style="color: #d50000;">&#x272a;</span> This location cannot accept your recyclables</span>
                        HTML;

                        echo '<ul class="home-shortcut-list">';

                        $markerName = "A";

                        foreach ($recyclingCenterAllList as $recyclingCenter)
                        {
                            echo <<<HTML
                                <li class="home-shortcut-list__item">
                                    <span style="font-size: 2rem;">{$markerName}</span><br />
                                    <b>{$recyclingCenter->getName()}</b>
                                </li>
                            HTML;

                            $markerName = chr(ord($markerName) + 1);
                        }

                        echo '</ul><ul class="home-shortcut-list">';

                        foreach ($recyclingCenterSomeList as $recyclingCenter)
                        {
                            echo <<<HTML
                                <li class="home-shortcut-list__item">
                                    <span style="font-size: 2rem;">{$markerName}</span><br />
                                    <b>{$recyclingCenter->getName()}</b>
                                </li>
                            HTML;

                            $markerName = chr(ord($markerName) + 1);
                        }

                        echo '</ul>';

                        echo <<<HTML
                            </section>
                        HTML;
                    }
                    else
                    {
                        // TODO: Display better message if there are no recycling centers available
                        echo "No recycling centers available";
                    }
                }
            }
            ?>
        </main>
    </body>
</html>