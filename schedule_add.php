<?php
include_once("./class/User.php");
include_once("./config/dbconfig.php");

session_start();

if (isset($_POST['submit']))
{
    $stmt = $dbConnection->prepare(<<<SQL
        INSERT INTO Schedule (UserId, Date, Time, PlannedActivity, ActualActivity, Mood)
        VALUES (?, ?, ?, ?, ?, ?)
SQL
    );

    $stmt->execute([
        $_SESSION['activeUser']->getId(),
        $_POST['date'],
        $_POST['time'],
        $_POST['plannedActivity'],
        $_POST['actualActivity'],
        $_POST['mood'],
    ]);

    header("location: ./schedule.php?d={$_POST['date']}");
}
else
{
    header("location: ./login.php");
}