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
        <title><?php echo APP_NAME ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <?php include("./style.php"); ?>

        <style>
            .main-content
            {
                margin: auto;
                background: linear-gradient(to bottom, var(--color-primary-muted), var(--color-primary-muted--dark));
            }

            .header
            {
                background: linear-gradient(to bottom, var(--color-accent-muted--light) 60%, var(--color-primary-muted));
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                min-height: 100vh;
                padding: 48px 32px;
            }

            .main-content__section
            {
                margin: auto;
            }

            .title
            {
                font-size: 32px;
                font-weight: 600;
                letter-spacing: 4px;
                text-align: center;
            }

            .subtitle
            {
                font-size: 16px;
                text-align: center;
            }
        </style>
    </head>

    <body>
        <header class="header">
            <span class="title text-heading"><?php echo APP_NAME ?></span>
            <span class="subtitle text-heading">Something something something something something</span>
            <div style="margin: 10px;">
                <a href="./login.php">
                    <button class="button button--cut-right">Log in</button>
                </a>

                <a href="./register.php">
                    <button class="button button--cut-left">Sign up</button>
                </a>
            </div>

            <div>
                <a class="text-link" href="#about">&#709; About <?php echo APP_NAME ?> &#709; </a>
            </div>
        </header>

        <main class="main-content" id="about">
            <section class="main-content__section">
                <h1 class="text-h1">What is <?php echo APP_NAME ?>?</h1>

                <?php
                // TODO: Provide better about us text
                ?>
                
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.</p>

                <p>Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien.</p>

                <p>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac</p>
            </section>
        </main>
    </body>
</html>