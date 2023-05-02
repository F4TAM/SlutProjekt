<?php
session_start();

$tempEmail = $_POST["Email"];
$tempName = $_POST["Name"];
$TempPassword = $_POST["Password"];

$db = new SQLite3('SiSiTing.sq3');
$db->exec("CREATE TABLE IF NOT EXISTS Accounts (
    AccountID INTEGER PRIMARY KEY AUTOINCREMENT, 
    Name TEXT, 
    Email TEXT, 
    Password TEXT, 
    FollowerCount INTEGER, 
    FollowingCount INTEGER
    )");


if(strlen($_POST["Name"])>0 && strlen($_POST["Email"])>0 && strlen($_POST["Password"])>0)
{
    $db->exec("INSERT INTO Accounts(Name, Email, Password) 
    VALUES('".$tempName."','".$tempEmail."','".hash('sha3-512',$TempPassword)."');");

    echo "Awaiting Administrations confirmation!";
    $db->close();
}
else
{
$_SESSION["message"] = "PLEASE FILL OUT ALL FIELDS.";
header("Location: Register.php");
exit();
}
?>
