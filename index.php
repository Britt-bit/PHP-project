<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP project</title>
</head>
<body>
    <h1>Je bent ingelogd</h1>
    <a href="logout.php" class="nav-link">Logout</a>
    <a class="nav-link" href="profile.php?id=<?php $_SESSION['user_id'][0] ?>">Profiel</a>
    <a class="nav-link" href="match.php?id=<?php $_SESSION['email'] ?>">Mijn matches</a>

    <?php 

    include_once(__DIR__ ."../includes/nav.inc.php");

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


    $countUsers = User::countUsers();
    foreach($countUsers as $count) {
        echo "Buddiez heeft $count gerigistreerde gebruikers";
    }
    
    /*$countBuddyAgreements = User::countBuddyAgreements();
    foreach($countBuddyAgreements as $count) {
        echo "Bij Buddiez zijn er al $count buddie overeenkomsten gevonden";
    }*/

    

    
    ?>
</body>
</html>
