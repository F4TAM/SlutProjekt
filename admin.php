<html>
    <head>
        <link rel ="stylesheet" href="admin.css">
    </head>
</html>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
  // Check the submitted username and password
  if (isset($_POST['username']) == 'admin' && $_POST['password'] == 'password') 
  {
    // If the username and password are correct, set the session variable
    $_SESSION['loggedin'] = true;
  }
} 
elseif (isset($_GET['action']) && $_GET['action'] == 'logout') 
{
  // User clicked the logout button, destroy the session
  session_destroy();
  $_SESSION = array();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) 
{
  // User is not logged in, show the login form
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Animated Register Form</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="center">
      <h1>Admin</h1>
      <form method="post" action="admin.php">
        <div class="txt_field">
          <input type="text" name="username" maxlenght="64" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" maxlenght="32" required>
          <span></span>
          <label >Password</label>
        </div>
        <div class="pass"></div>
        <input type="submit" value="Register">
        <div class="signup_link">
          Not a Admin? <a href="LogIn.php">Log in</a>
        </div>
      </form>
    </div>
</html>

<!--
<html>
<head>
<link rel="stylesheet" href="admin.css"> 
</head>
<body>
<form method="post" action="admin.php">
  <div class="inputBox">
    <span>Username: </span>
    <input type="text" id="username" name="username" required><br>
  </div>
  <div class="inputBox">
    <span>Password:</span>
    <input type="password" id="password" name="password" required><br>
  </div>

  <input type="submit" value="Login">
</form>  
</body>
</html> -->
<?php
}
 else 
 {
  // Admin is logged in, show the admin page and logout button
?>
  <h1>Welcome, admin!</h1>
  <p>Here is some content that only logged-in users can see.</p>

  <?php

  // Open the database connection
  $db = new SQLite3('SiSiTing.sq3');

  // calls the displayPreAccountsTable function
  displayPreAccountsTable($db);
  ?>

  <!-- Button for Admin to logut, action logout -->
  <form method="get" action="admin.php">
  <input type="hidden" name="action" value="logout">
  <input type="submit" value="Logout">
  </form>

  <div class="notification">
  <p>Welcome back, Admin!</p>
  <span class="notification__progress"></span>
  </div>
<?php
}
?>

<?php
function displayPreAccountsTable($db) 
{
  // Build the query to retrieve all records from the PreAccounts table
  $query = 'SELECT Name, Email, Password FROM PreAccounts';

  // Execute the query and get the result set
  $result = $db->query($query);

  // Check if there are any rows in the result set
  if($result->numColumns() > 0) 
  {
    // If there are rows, display them in a table
    ?>
   <form method="post" action="admin.php"> 
    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
      </tr>

      <?php
      // Loop through each row in the result set
      while($row = $result->fetchArray(SQLITE3_ASSOC)) 
      {
      ?>
          <tr>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['Password']; ?></td>
            <td><input type="hidden" name="email" value="<?php echo $row['Email']; ?>"></td>
            <td><input type="submit" name="delete" value="Delete"></td>
            <td><input type="checkbox" name="accounts[]" value="<?php echo $row['Email']; ?>"></td>
          </tr>
      <?php
      }
      ?>

    </table>
    <input type="submit" value="Accept selected accounts">
    </form>
    <?php
  }
  else 
  {
    // If there are no rows, display a message
    echo '<p>No results found.<p>';
  }

  // Handle the delete request
  if(isset($_POST['delete']))
  {

    // Get the email of the selected row to delete 
    $email = $_POST['email'];

    // Build the query to delete the selected row from the PreAccounts table
    $query = "DELETE FROM PreAccounts WHERE Email = '" . $email . "'";

    // Execute the query
    $db->query($query);

    header("Refresh:0");
    // Display a message to confirm the deletion
    echo '<p>Selected row has been deleted.</p>';
  }

  // Check if the form was submitted
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accounts']) && !isset($_POST['delete']))
  {
    if($result->numColumns() > 0)
    {
      while($row = $result->fetchArray(SQLITE3_ASSOC))
      {
        // Check if the row is valid before accesing the values
        if(isset($row['Name']) && isset($row['Password']))
        {
          $email = $row['Email']; // Set the email variable

          // Loop through the selected accounts and insert them into the Accounts table
          foreach($_POST['accounts'] as $email)
          {
            $query = "INSERT INTO Accounts (Name, Email, Password) VALUES 
            ('" . $row['Name'] . "', '" . $email . "', '" . $row['Password'] . "')";
            $db->exec($query); // Execute the insert statement

            // Get the email of the selected row to delete 
            $email = $_POST['email'];

            // Build the query to delete the selected row from the PreAccounts table
            $query = "DELETE FROM PreAccounts WHERE Email = '" . $email . "'";

            // Execute the query
            $db->query($query);
          }
        }
      }
      header("Refresh:0");
      echo "Accounts inserted into table Accounts!";
    }
  }

  // Close the database connection
  $db->close();
}
?>