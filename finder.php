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
    <input type="text" name="search" placeholder="Search">
    <button type="submit" name="submit-search">Search</button>
</form>

<h1>Front page</h1>
<h2>All articles:</h2>

<div class="lokaal-container">
    <?php

    $conn = Db::getConnection();
    
    $sql = $conn->prepare("SELECT * FROM `finder`");
    $sql->execute();
    //var_dump($sql);
    $queryResults = $sql->fetch(PDO::FETCH_COLUMN);
    //$queryResults->execute();
    //return $queryResults;
    
    //var_dump($queryResults);

        //$sql = "SELECT * FROM finder";
        //$result = mysqli_query($conn, $sql);
        

        if($queryResults > 0){
            //var_dump($queryResults);
            while($row = $sql->fetch( PDO::FETCH_ASSOC)){
                //var_dump($row);
                echo "<div>
                    <h3>".$row['classroom']."</h3>
                </div>";
            }
        }
    ?>
</div>
    
</body>
</html>