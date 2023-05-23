<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Register Form</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="center">
      <h1>Register</h1>
      <form method="post" action="CreateAccount.php">
        <div class="txt_field">
            <input type="text" name="Email" maxlenght="64" required>
            <span></span>
            <label>Email</label>
        </div>
        <div class="txt_field">
          <input type="text" name="Name" maxlenght="64" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="Password" maxlenght="32" required>
          <span></span>
          <label >Password</label>
        </div>
        <div class="pass"></div>
        <input type="submit" value="Register">
        <div class="signup_link">
          Already a member? <a href="Index.php">Log in</a>
        </div>
      </form>
    </div>
</html>
