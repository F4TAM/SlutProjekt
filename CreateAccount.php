<?php
session_start();

$tempEmail = $_POST["Email"];
$tempName = $_POST["Name"];
$TempPassword = $_POST["Password"];

if(strlen($_POST["Name"])>0 && strlen($_POST["Email"])>0 && strlen($_POST["Password"])>0)
{
    $db = new SQLite3('SiSiTing.sq3');
    $db->exec("INSERT INTO Accounts(Name, Email, Password) 
    VALUES('".$tempName."','".$tempEmail."','".hash('sha3-512',$TempPassword)."');");

    echo "<Body bgcolor=\"436346\">Account have been created!";
}
else
{
$_SESSION["message"] = "PLEASE FILL OUT ALL FIELDS.";
header("Location: Register.php");
exit();
}
?>
