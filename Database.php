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
Title TEXT,
Content TEXT,
Likes INTEGER,
FOREIGN KEY (accountID) REFERENCES Accounts(AccountID)
)");

// Create table Comments 
$db->exec("CREATE TABLE IF NOT EXISTS Comments(
CommentID INTEGER PRIMARY KEY AUTOINCREMENT,
PostID INTEGER,
AccountID INTEGER,
Content TEXT,
Likes INTEGER,
FOREIGN KEY(AccountID) REFERENCES Accounts(AccountID),
FOREIGN KEY(PostID) REFERENCES Posts(PostID)
)");

// Create table Followers 
$db->exec("CREATE TABLE IF NOT EXISTS Followers(
AccountID INTEGER,
FollowerAccountID INTEGER,
FOREIGN KEY(AccountID) REFERENCES Accounts(AccountID),
FOREIGN KEY(FollowerAccountID) REFERENCES Accounts(AccountID)
)");

// Create table PreAccounts
$db->exec("CREATE TABLE IF NOT EXISTS PreAccounts(
AccoundID INTEGER PRIMARY KEY AUTOINCREMENT,
Name TEXT,
Email TEXT,
Password TEXT
)");
    
//close the database connection
$db->close();

header("location: Index.php");
?>