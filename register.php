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
        <title>Register - <?php echo APP_NAME ?></title>

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
                <form class="form form--centered" action="./register_send.php" method="POST">
                    <div class="form__item">
                        <h1 class="text-h2">Create a new account</h1>
                    </div>

                    <div class="banner">
                        Your password must contain the following:
                        <ul style="list-style-type: circle; margin-left: 24px;">
                            <li>At least 8 characters</li>
                            <li>At least 1 number</li>
                        </ul>
                    </div>

                    <div class="form__item">
                        <label class="textbox-label" for="user">Email address</label>
                        <input class="textbox" type="text" name="email" />
                    </div>

                    <div class="form__item">
                        <label class="textbox-label" for="user">Password</label>
                        <input class="textbox" type="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"" />
                    </div>

                    <div class="form__item">
                        <label class="textbox-label" for="user">First name</label>
                        <input class="textbox" type="text" name="firstName" />
                    </div>

                    <div class="form__item">
                        <label class="textbox-label" for="user">Last name</label>
                        <input class="textbox" type="text" name="lastName" />
                    </div>

                    <div class="form__item">
                        <input class="button" type="submit" name="submit" value="Register" />
                    </div>

                    <div class="form__item">
                        <span>Already have an account? <a class="text-link" href="./login.php">Login</a></span>
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>