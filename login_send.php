<?php
include_once("./class/User.php");

session_start();

$loginAttempt = User::getUserFromEmailAddress($_POST['user']);

if ($loginAttempt != null
    && $loginAttempt->isPasswordValid($_POST['password']))
{
    $_SESSION['activeUser'] = $loginAttempt;

    header("location: ./home.php");
}
else
{
    header("location: ./login.php?e=1");
}