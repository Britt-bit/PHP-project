<?php
session_start();
//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");


error_reporting(E_ALL);
ini_set('display_errors', 1);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <title>Home</title>
</head>
<body>
<img class="logo" src="./images/logo.png" alt="Buddiez logo">
    <nav>
    <a href="logout.php" class="nav-link">Logout</a>
    <a class="nav-link" href="profile.php?id=<?php $_SESSION['user'][0] ?>">Profile</a>
    </nav>

    <?php 
    //check of user features al ingevuld heeft. zoniet->redirect naar invulformulier
    $checkFeatures = feature::checkFeatures();
    if ($checkFeatures == false){
        //echo"features nog niet ingevuld";
        header("Location: features.php");
        exit();
    }


    // laten zien wanneer hobby nog niet is ingevuld 
    $hobby = feature::hobby();
    if(empty($hobby)){
        echo"hobby nog niet ingevuld";
        include_once(__DIR__ ."/completeFeatures.php");
    }  
    ?>
</body>
</html>
