<?php
include_once("./class/Psychiatrist.php");
include_once("./class/User.php");

session_start();

if (isset($_POST['submit']))
{
    $psych = new Psychiatrist();
    $psych->loadData($_POST['id']);

    $psych->addRating($_POST['rating'], $_POST['review'], $_SESSION['activeUser']->getId());

    header("location: ./psych.php?id={$_POST['id']}");
}
else
{
    header("location: ./");
}