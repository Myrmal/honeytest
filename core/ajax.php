<?php
include('MysqlClass.php');
$db = new MysqlClass();

$error = false;

if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["message"])) {
    $error = true;
} else {
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
}

if ($error)
{
    $db->resultTable();
} else {
    $db ->insertIntoTable($name,$email,$message);
    $db->resultTable();
}
