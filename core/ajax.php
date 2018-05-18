<?php
include('MysqlClass.php');
$db = new MysqlClass();

$error = false;

if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_POST["message"])) {
    $error = true;
} else {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
}

if ($error)
{
    $db->resultTable();
} else {
    $db ->insertIntoTable($name,$email,$message);
    $db->resultTable();
}