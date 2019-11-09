<?php
include_once("class/User.php");
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
        <title>Tips and advice - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#selfhelp"><i class="fa fa-angle-double-left"></i> Lifestyle treatments</a></h2>
            <h1 class="text-h1" style="padding: 0;">Tips and advice</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h2 class="text-h3">Take a Walk</h2>
                <p>Taking a walk helps you to clear out your head, and also functions as light exercise. Plus, some fresh air is always good for the body and mind.</p>

                <h2 class="text-h3">Meditate</h2>
                <p>Meditation allows you to reduce stress and control your anxiety by putting yourself in the present moment. If you want to learn how to meditate, you can check out this <a href="https://youtu.be/mMMerxh_12U" class="text-link"><i class="fa fa-film"></i> beginner's guide to meditation</a> by Improvement Pill on YouTube. We've also got some relaxing music on the <a href="./audiovisual.php" class="text-link"><i class="fa fa-file-audio"></i> Videos and Music</a> page.

                <h2 class="text-h3">Spend Time With Your Pet</h2>
                <p>Your dog or cat (or some other lovable creature) may be fluffy, funny, and all around derpy, but pets have been proven to keep your mind sharp and provide companionship. There are lots of <a href="https://shopessentialseveryday.com/" class="text-link"><i class="fa fa-link"></i> ways to bond and spend time with your pet</a>, so don't be shy!</p>

                <h2 class="text-h3">Get More Sleep</h2>
                <p>Don't stay past your bedtime if you don't need to! Sleep deprivation can lower your immune system's effectiveness, and can affect your health, performance, and safety. Don't compromise your sleep just because you've got that one project that you desperately need to finish tomorrow. (Unless you're us, in which case...)</p>

                <h2 class="text-h3">Keep a positive attitude</h2>
                <p>The first stepping stone to happiness is believing that you are happy. Surround yourself with things that you love, and you'll find that it becomes easier to do.</p>

                <h2 class="text-h3">Exercise</h2>
                <p>As someone once said, "exercise equals dopamine". Even light exercise every day will do wonders for you.</p>

                <h2 class="text-h3">Eat healthy</h2>
                <p>Every mother in the world will want to force their child to eat that one piece of broccoli, but there's a good reason for that. A healthy diet can help you lose weight, lower your cholesterol levels and blood pressure and decrease your risk of type 2 diabetes. If you hate "healthy food" because you don't like the taste of vegetables, you'll be glad to know that there are lots of <a href="https://www.eatthismuch.com/" class="text-link"><i class="fa fa-link"></i> healthy recipes that taste great</a>.</p>

                <h2 class="text-h3">Make time for hobbies, interests, and relaxation</h2>
                <p>Overloaded with work? Maybe step back for a bit and take a break. Taking time for yourself is just as important as working.</p>

                <h2 class="text-h3">Learn to love yourself</h2>
                <p>Your feelings are valid. Everybody makes mistakes, but if you keep thinking that your mistakes are who you are, then you will quickly become your own worst enemy.</p>

                <h2 class="text-h3">Chew Gum</h2>
                <p>Everyone loves a good stick of gum, and it may actually help to calm your nerves. The saliva and an increase in blood flow can end up calming your mind, allowing you to relax in some different ways. Gum will actually reduce your stress levels as well; cortisol levels have been lower in traditional gum chewers.</p>

                <h2 class="text-h3">Listen to Soothing Music</h2>
                <p>Try playing some music to help you relax. You may find your mind as soothed as your ears are. Or, you could pop in your favorite playlist and jam along. If you're interested, we've got some great tracks in the <a href="./audiovisual.php" class="text-link"><i class="fa fa-file-audio"></i> Videos and Music</a> page.</p>

                <h2 class="text-h3">Enjoy Aromatherapy</h2>
                <p>Your house will not only smell great, but studies have shown that <a href="https://shopessentialseveryday.com/" class="text-link"><i class="fa fa-link"></i> aromatherapy</a> might have health benefits, including:
                    <ul class="bulleted-list">
                        <li>Relief from anxiety and depression</li>
                        <li>Improved quality of life, particularly for people with chronic health conditions</li>
                        <li>Improved sleep</li>
                    </ul>
                </p>
            </section>
        </main>
    </body>
</html>