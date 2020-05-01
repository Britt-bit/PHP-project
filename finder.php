<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include_once(__DIR__ . "/classes/Finder.php");
include_once(__DIR__ . "/classes/Db.php");
//$conn = Db::getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="search-classroom.php" method="POST">
    <input type="text" name="search" placeholder="Search classroom">
    <button type="submit" name="submit-search">Search</button>
</form>
</body>
</html>