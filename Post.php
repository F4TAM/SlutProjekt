<?php
session_start();

$_SESSION['Posting'] = false;

if (isset($_GET['action']) && $_GET['action'] == 'Posting') 
{
    $_SESSION['Posting'] = true;
}
elseif(isset($_GET['action']) && $_GET['action'] == 'post')
{
    $_SESSION['Posting'] = false;
}
elseif(isset($_GET['action']) && $_GET['action'] == 'noPost')
{
    $_SESSION['Posting'] = false;
}
if($_SESSION['Posting'] == true)
{
?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Post Form</title>
    <link rel="stylesheet" href="login.css">
  </head>
  <body>
    <div class="center">
      <h1>Posting</h1>
      <form method="post" action="Postdb.php">
        <div class="txt_field">
            <input type="text" name="Title" maxlenght="64" required>
            <span></span>
            <label>Title</label>
        </div>
        <div class="txt_field">
          <input type="text" name="Content" maxlenght="64" required>
          <span></span>
          <label>Content</label>
        </div>
        <form method="get" action="Post.php">
            <input type="hidden" name="action" value="post">
            <input type="submit" value="Post?">
        </form>
      </form>
        <form method="post" action="Post.php">
            <input type="hidden" name="action" value="noPost">
            <input type="submit" value="Back?">
        </form>
    </div>
</html>

<?php
}
?>

<?php
if($_SESSION['Posting'] == false)
{
?>
<html>
    <head>
        <link rel="stylesheet" href="Post.css">
    </head>


<body>
    <div class="center">
        <?php
            $db = new SQLite3('SiSiTing.sq3');
            $stmt = $db->prepare('SELECT Title, Content FROM Posts');
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_ASSOC))
            {
                echo '<div class="post">';
                echo '<h2>' . $row['Title'] . '</h2>';
                echo '<p>' . $row['Content'] . '</p>';
                echo '</div>';
            }

        $result->finalize();
        $db->close();
        ?>
    </div>

  <form method="get" action="Index.php">
  <input type="submit" value="Logout">
  </form>
</body>

<form method="get" action="Post.php">
<input type="hidden" name="action" value="Posting">
<input type="submit" value="Post?">
</form>
</html>


<?php
}
?>

