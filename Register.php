<?php
session_start();
if(isset($_SESSION["message"]))
{
    echo $_SESSION["message"];
    unset($_SESSION["message"]);
}
?>

<html>
<head><title>REGISTER</title></head>
<body>
<BR><BR>
Here you register a new account!<BR><BR>
<form action="CreateAccount.php" method = "POST">
Email: <input type="text" name = "Email"><BR>
Username: <input type="text" name = "Name"><BR>
Password: <input type="password" name = "Password"><BR>
<input type="submit">
</form>


</body>



</html>