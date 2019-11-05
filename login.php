<?php
include_once("config/appconfig.php");
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Login - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <main class="main-content" id="about">
            <section class="main-content__section main-content__section--small">
                <h1>Login to <?php echo APP_NAME ?> account</h1>

                <form class="form form--centered" action="./login_send.php" method="POST">
                    <div class="form__item">
                        <label class="textbox-label" for="user">Username</label>
                        <input class="textbox" type="text" name="user" />
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