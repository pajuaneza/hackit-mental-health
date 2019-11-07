<nav class="navbar">
    <div class="navbar__left">
        <div class="navbar__entry text-h4">
            <a href="./"><?php echo APP_NAME ?></a>
        </div>
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
                        <button class="button"><i class="fa fa-sign-out"></i> Logout</button>
                    </a>
                </div>
            </div>
        HTML;
    }
    ?>
</nav>