<?php
include_once("./class/User.php");

session_start();

const USERNAME_FIRST = array(
    'Fluffy',
    'Orange',
    'Pretty',
    'Spicy', 'Sweet',
    'Tangy',
);

const USERNAME_SECOND = array(
    'Cloud',
    'Flower',
    'Game',
    'Penguin',
    'Rain',
    'Sheep',
);

$newUsername = USERNAME_FIRST[rand(0, count(USERNAME_FIRST) - 1)] . USERNAME_SECOND[rand(0, count(USERNAME_SECOND) - 1)] . sprintf('%02d', rand(0, 99));

if (isset($_POST['submit']))
{
    $newUser = new User();

    $newUser->setEmailAddress($_POST['email']);
    $newUser->setPassword($_POST['password']);
    $newUser->setFirstName($_POST['firstName']);
    $newUser->setLastName($_POST['lastName']);
    $newUser->setUsername($newUsername);

    if ($newUser->saveData())
    {
        $_SESSION['activeUser'] = $newUser;
        header("location: ./home.php");
    }
    else
    {
        header("location: ./login.php?e=1");
    }
}
else
{
    header("location: ./login.php");
}