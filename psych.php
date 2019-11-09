<?php
include_once("class/Psychiatrist.php");
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    header("location: logout.php");
}
else if (!isset($_GET['id']))
{
    header("location: ./search_psych.php");
}

$currentPsych = new Psychiatrist();
$currentPsych->loadData($_GET['id']);
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title><?php echo $currentPsych->getName() ?> - Psychiatrist profile - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./search_psych.php"><i class="fa fa-angle-double-left"></i> Find psychiatrists</a></h2>
            <h1 class="text-h1" style="padding: 0;"><?php echo $currentPsych->getName() ?></h1>
            <h2 class="text-subtitle">Average rating: <i class="fa fa-star"></i> <?php echo number_format($currentPsych->getAverageRating(), 2); ?></h2>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h2">About <?php echo $currentPsych->getName() ?></h2>
                <p><?php echo nl2br($currentPsych->getDescription()) ?></p>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Contact information</h2>
                <div>Address: <?php echo $currentPsych->getAddress(); ?></div>
                <div>Contact number: <a class="text-link" href="tel:<?php echo $currentPsych->getContactNumber()?>"><?php echo $currentPsych->getContactNumber()?></a></div>
                <div>Email address: <a class="text-link" href="mailto:<?php echo $currentPsych->getEmailAddress()?>"><?php echo $currentPsych->getEmailAddress()?></a></div>
            </section>

            <section class="main-content__section">
                <h2 class="text-h2">Ratings and reviews</h2>
                <ul>
                    <?php
                    foreach ($currentPsych->getRatings() as $rating)
                    {
                        echo <<<HTML
                            <li class="chat-bubble" style="
                            margin: 8px;">
                                <i class="fa fa-star"></i> {$rating['Rating']}<br />
                                {$rating['Comment']}<br />
                                 &#x2014;{$rating['Rater']->getUsername()}
                            </li>
                        HTML;
                    }
                    ?>
                </ul>

                <form class="form" action="psych_review_add.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">

                    <div class="form__item--inline">
                        <label class="textbox-label" for="review">Add a rating</label>
                        <input class="textbox" type="number" name="rating" min=1 max=5 value="5" required />
                    </div>

                    <div class="form__item">
                        <label class="textbox-label" for="review">Leave a review</label>
                        <textarea class="textbox textarea" type="text" name="review" required></textarea>
                    </div>

                    <div class="form__item form__item--inline">
                        <input class="button" type="submit" name="submit" value="Submit review" onclick="addDiaryEntry();" />
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>