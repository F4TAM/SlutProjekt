<?php
$db = new SQLite3('SiSiTing.sq3'); // creates database
//Creates a accounts table if it doesnt exists by the SiSiTing.sq3 database. 
$db->exec("CREATE TABLE IF NOT EXISTS Accounts (
AccountID INTEGER PRIMARY KEY AUTOINCREMENT, 
Name TEXT, 
Email TEXT, 
Password TEXT, 
FollowerCount INTEGER, 
FollowingCount INTEGER
)");

//Create table Posts
$db->exec("CREATE TABLE IF NOT EXISTS Posts(
PostID INTEGER PRIMARY KEY AUTOINCREMENT,
AccountID INTEGER,
Content TEXT,
Likes INTEGER
FOREIGN KEY (accountID) REFERENCES Accounts(AccountID)
)");

$db->exec("CREATE TABLE IF NOT EXISTS Comments(
CommentID INTEGER PRIMARY KEY AUTOINCREMENT,
PostID INTEGER,
AccountID INTEGER,
Content TEXT,
Likes INTEGER,
FOREIGN KEY(AccountID) REFERENCES Accounts(AccountID),
FOREIGN KEY(PostID) REFERENCES Posts(PostID)
)")
//close the database connection
$db->close();
?>