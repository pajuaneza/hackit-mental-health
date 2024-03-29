<?php
include_once("config/appconfig.php");

session_start();

if (isset($_SESSION['activeUser']))
{
    header("location: ./home.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Login - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            .navbar
            {
                background-color: transparent;
            }
        </style>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <main class="main-content" id="about">
            <section class="main-content__section main-content__section--small">
                <form class="form form--centered" action="./login_send.php" method="POST">
                    <div class="form__item">
                        <h1 class="text-h2">Log into account</h1>

                        <?php
                        if (isset($_GET['e']))
                        {
                            echo <<<HTML
                                <div class="banner banner--error">Incorrect email address/password</div>
                            HTML;
                        }
                        ?>
                    </div>
                    <div class="form__item">
                        <label class="textbox-label" for="user">Email address</label>
                        <input class="textbox" type="email" name="user" />
                    </div>

                    <div class="form__item">
                        <label class="textbox-label" for="user">Password</label>
                        <input class="textbox" type="password" name="password" />
                    </div>

                    <div class="form__item">
                        <input class="button" type="submit" value="Login" />
                    </div>

                    <div class="form__item">
                        <span>Don't have an account yet? <a class="text-link" href="./register.php">Register</a></span>
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>