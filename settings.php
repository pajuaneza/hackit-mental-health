<?php
include_once("class/User.php");
include_once("config/appconfig.php");

session_start();

if (!isset($_SESSION['activeUser']))
{
    session_destroy();
    header("location: ./logout.php");
}
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Home - <?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>
    </head>

    <body>
        <?php include("./navbar.php"); ?>

        <header class="header">
            <h2 class="text-overline"><a class="text-link" href="./home.php#myaccount"><i class="fa fa-angle-double-left"></i> My account</a></h2>
            <h1 class="text-h1" style="padding: 0;">Account settings</h1>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <?php
                if (isset($_GET['successPassword']))
                {
                    echo <<<HTML
                        <div class="banner banner--success">Password changed</div>
HTML;
                }

                if (isset($_GET['errorPasswordVerify']))
                {
                    echo <<<HTML
                        <div class="banner banner--error">New passwords do not match</div>
HTML;
                }

                if (isset($_GET['errorPasswordCurrent']))
                {
                    echo <<<HTML
                        <div class="banner banner--error">Incorrect password</div>
HTML;
                }
                ?>

                <h2 class="text-h2">Account information</h2>

                <section>
                    <h3 class="text-h3">Account password</h3>

                    <div class="banner">
                        Your password must contain the following:
                        <ul style="list-style-type: circle; margin-left: 24px;">
                            <li>At least 8 characters</li>
                            <li>At least 1 number</li>
                        </ul>
                    </div>

                    <form class="form" action="./settings_change_password.php" method="POST">
                        <input
                            type="hidden"
                            name="username"
                            value="<?php echo $_SESSION['activeUser']->getUsername(); ?>"
                        />

                        <div class="form__item">
                            <label class="text-overline" for="address">Current password</label>
                            <input
                                class="textbox"
                                type="password"
                                name="passwordCurrent"
                                required
                            />
                        </div>

                        <div class="form__item">
                            <label class="text-overline" for="passwordNew">New password</label>
                            <input
                                class="textbox"
                                type="password"
                                name="passwordNew"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                required
                            />
                        </div>

                        <div class="form__item">
                            <label class="text-overline" for="passwordNewVerify">Retype new password</label>
                            <input
                                class="textbox"
                                type="password"
                                name="passwordNewVerify"
                                pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                                required
                            />
                        </div>

                        <input class="button button--raised button--colored" name="submit" type="submit" value="Change password" />
                    </form>
                </section>
            </section>
        </main>
    </body>
</html>