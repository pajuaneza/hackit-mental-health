<?php
include_once("./class/DiaryEntry.php");
include_once("./class/User.php");

session_start();

if (isset($_SESSION['activeUser'], $_REQUEST['q']))
{
    $diary = new DiaryEntry();
    $diary->setUserId($_SESSION['activeUser']->getId());
    $diary->setContent($_REQUEST['q']);
    $diary->saveData();
}