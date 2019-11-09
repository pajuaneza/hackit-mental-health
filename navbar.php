<nav class="navbar">
    <div class="navbar__left">
        <a href="./" class="navbar navbar__entry">
            <div class="navbar__entry">
                <img src="./res/logo/logo_transparent2.png" style="height: 37px; filter: invert(100%);" alt="logo" />
            </div>

            <div class="navbar__entry text-h3">
                <?php echo APP_NAME ?>
            </div>
        </a>
    </div>

    <?php
    if (isset($_SESSION['activeUser']))
    {
        echo <<<HTML
            <div class="navbar__right">
                <div class="navbar__entry">
                    {$_SESSION['activeUser']->getFirstName()} {$_SESSION['activeUser']->getLastName()}
                </div>
                 
                <div class="navbar__entry">
                    <a href="./logout.php">
                        <button class="button"><i class="fa fa-sign-out-alt"></i> Logout</button>
                    </a>
                </div>
            </div>
        HTML;
    }
    ?>
</nav>