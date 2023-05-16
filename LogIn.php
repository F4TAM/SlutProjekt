<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Animated Login Form</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post" action="LogIn.php">
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
        <div class="pass">Forgot Password?</div>
        <input type="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="#">Signup</a>
        </div>
      </form>
    </div>

    <?php
    // Connect to the SQLite3 databse
    $db = new SQLite3('SiSiTing.sq3');
    
    // Check if the form was submitted
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      // Retrieve the submitted username and password
      $username = $_POST['username'];

      $password = hash('sha3-512',$_POST['password']);

      // Prepare a SQL statement to check if the user exists in the database
      $stmt = $db ->prepare('SELECT * FROM Accounts WHERE Name = :username AND Password = :password');
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':password', $password);

      // Execute the SQL statement
      $result = $stmt->execute();

      // Check if a row is returned, indicating successful login
      if($result->fetchArray(SQLITE3_ASSOC))
      {
        echo 'Login successful!';
        // Redirect to a success page or perform further actions
      }
      else
      {
        echo 'Invalid username or password.';
        // Redirect to an error page or show an error message 
      }
    }

    // Close the databse connection
    $db->close();
    ?>



  </body>
  </head>






