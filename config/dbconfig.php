<?php
$dbHostname = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "hackit-recycle";

try
{
    $dbConnection = new PDO("mysql:host={$dbHostname};dbname={$dbName};charset=utf8", $dbUsername, $dbPassword);
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch (Exception $e)
{
    http_response_code(500);
    die();
}