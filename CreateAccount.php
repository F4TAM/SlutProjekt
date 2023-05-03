<?php
session_start();

$tempName = $_POST["Name"];
$tempPassword = $_POST["Password"];
$tempEmail = $_POST["Email"];


function test_input($data) 
{
    $data = trim($data); // remove leading/trailing whitespace
    $data = stripslashes($data); // remove backslashes
    $data = htmlspecialchars($data); // convert special characters to HTML entities
    return $data; 
}


$email = test_input($_POST["Email"]);
// check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    echo "Invalid email format";
    $insert = false;
}  
else
{
    $insert = true;
}


$db = new SQLite3('SiSiTing.sq3');
if($insert)
{
    $db->exec("INSERT INTO PreAccounts(Name, Email, Password) 
    VALUES('".$tempName."','".$tempEmail."','".hash('sha3-512',$tempPassword)."');");
    
    echo "Awaiting Administrations confirmation!";
}
$db->close();



?>
