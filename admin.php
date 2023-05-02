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
  if ($_POST['username'] == 'admin' && $_POST['password'] == 'password') 
  {
    $_SESSION['loggedin'] = true;
  }
} 
elseif (isset($_GET['action']) && $_GET['action'] == 'logout') 
{
    // User clicked the logout button, destroy the session
    session_destroy();
    $_SESSION = array();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  // User is not logged in, show the login form
?>
  <form method="post" action="admin.php">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Login">
  </form>
<?php
} else {
  // User is logged in, show the admin page and logout button
?>
  <h1>Welcome, admin!</h1>
  <p>Here is some content that only logged-in users can see.</p>
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