<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");
$user = new User();
$getUser = $user->getUserByEmail($_SESSION['email']);
$_SESSION['user_id'] = $getUser['user_id'];
include_once(__DIR__ ."/classes/Match.php"); 
$conn = Db::getConnection();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP project</title>
</head>
<body>
    <?php 

        //check of user features al ingevuld heeft. zoniet-> toon warning
        $checkFeatures = feature::checkFeatures();
        $hobby = feature::hobby();
            if ($checkFeatures == false){
            //echo"features nog niet ingevuld";
            //header("Location: features.php");
            //exit();

                include_once("includes/completeFeatures.inc.php");
    
            }

            // laten zien wanneer hobby nog niet is ingevuld 
            if(empty($hobby) && $checkFeatures == true ){
                include_once(__DIR__ ."/completeFeatures.php");

            }  


         include_once(__DIR__ ."../includes/nav.inc.php");

?>
<<<<<<< Updated upstream
=======

<form action="search-classroom.php" method="POST">
    <input type="text" name="search" placeholder="Search classroom">
    <button type="submit" name="submit-search">Search</button>
</form>

   <!--navigatie-->        
   <nav>
    <a style="color: rgb(245, 134, 124);"href="index.php?id=<?php echo $_SESSION['user_id'] ?>">Home</a>
    <a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>">Profile</a>
    <a href="buddies.php?id=<?php echo $_SESSION['user_id'] ?>">My buddies</a>
    <a href="match.php?id=<?php echo $_SESSION['user_id'] ?>">My matches</a>
    <a href="logout.php" class="logout">Logout</a>
    </nav>
>>>>>>> Stashed changes
    <h1>Je bent ingelogd</h1>
    <a href="logout.php" class="nav-link">Logout</a>
    <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user_id'] ?>">Profiel</a>
    <!-- <a class="nav-link" href="match.php?id=<?php echo $_SESSION['user_id']  ?>">Mijn matches</a> -->

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



<h1>My matches</h1>
    <form method="POST">
    <table>
        <tr>
            <!-- Alle mogelijke matches oplijsten
            Is nog niet verdeeld in buddy of geen buddy-->
        <?php 
        //features van alle andere gebruikers ophalen
        while($yourFeature = $statement->fetch( PDO::FETCH_ASSOC )){ 
            //loopen over alle mogelijke gebruikers in de database
            for ($counter = 0; $yourFeature = $statement->fetch( PDO::FETCH_ASSOC ); ++$counter){
                $yourGame = $yourFeature['games']; 
                $yourFilm = $yourFeature['films'];
                $yourMusic = $yourFeature['muziek']; 
                $yourCourse = $yourFeature['vak'];
                $yourHobby = $yourFeature['hobby']; 
                $yourName = $yourFeature['firstname'];
                $yourLastname = $yourFeature['lastname'];
                $yourEmail = $yourFeature['email'];
                $yourBuddy = $yourFeature['buddy'];

                $stmt = $conn->prepare("SELECT `user_id` FROM `user` WHERE email = :yourEmail");
                $stmt->bindParam(':yourEmail', $yourEmail);
                $stmt->execute();
                $yourID = $stmt->fetch(PDO::FETCH_COLUMN);

                //al deze features in een 2de array zetten
                $yourFeatureArray = array($yourGame, $yourFilm, $yourMusic, $yourCourse, $yourHobby);
                //De 2 arrays vergelijken om te zien welke features allemaal matchen.
                $result = array_intersect($myFeatures, $yourFeatureArray);


                $stmtStatus = $conn->prepare("SELECT `status` FROM `buddyChat`, `user` WHERE buddyChat.from_user_id = user.user_id AND buddyChat.from_user_id = $yourID AND `status` = 1");
                $stmtStatus->execute();
                $status = $stmtStatus->fetch(PDO::FETCH_COLUMN);
                //var_dump($status);


            if($yourBuddy != $buddy){
                if($yourID != $id){
                //als er 5 dezelfde features zijn ... 
                if(count($result) === 5){
                    echo "<br/>";
                    echo "<br/>";
                    print("You matched with " . htmlspecialchars($yourName) . " " . htmlspecialchars($yourLastname) . " on the features "); 
                        for($tel = 0; $tel < sizeof($result); ++$tel){
                            if($tel < sizeof($result) -1){
                                echo(htmlspecialchars($result[$tel]) . ", ");
                            } else {
                                echo(htmlspecialchars($result[$tel]) . ".");
                            }

                        }
                        if($status == 1){
                            $statusReturn = '<p>New message</p>';
                         } else {
                             $statusReturn = "";
                         }
                    echo '<button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'. $yourID . '" data-tousername="'. $yourName . '">Buddy request</button>';
                    echo '<a class="btn btn-info btn-xs ml-3" href="profile.php?id='. $yourID . '>watch profile</a>';
                    
                ?>
            </tr>
            <?php
                }else if(count($result) === 4){
                    echo "<br/>";
                    echo "<br/>";
                    print("You matched with " . htmlspecialchars($yourName) . " " . htmlspecialchars($yourLastname) . " on the features "); 
                    for($tel = 0; $tel < count($result) +2; ++$tel){
                        echo(htmlspecialchars($result[$tel]) . "  ");
                    }
                    if($status == 1){
                        $statusReturn = '<p>New message</p>';
                     } else {
                         $statusReturn = "";
                     }
                    echo '<button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'. $yourID . '" data-tousername="'. $yourName . '">Buddy request</button>';
                    echo '<a class="btn btn-info btn-xs ml-3" href="profile.php?id='. $yourID . '">watch profile</a>';
            ?>
            </tr>
            <?php
                } else if(count($result) === 3){
                    echo "<br/>";
                    echo "<br/>";
                    //<p style='margin-left:20px';> 
                    echo("You matched with " . htmlspecialchars($yourName) . " " . htmlspecialchars($yourLastname) . " on the features "); 
                    for($tel = 0; $tel < count($result) +2; ++$tel){
                        echo(htmlspecialchars($result[$tel]) . " ");   
                    }
                    //echo("</p>");
                    if($status == 1){
                        $statusReturn = '<p>New message</p>';
                     } else {
                         $statusReturn = "";
                     }
                echo '<button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'. $yourID . '" data-tousername="'. $yourName . '">Buddy request</button>';
                echo '<a class="btn btn-info btn-xs ml-3" href="profile.php?id='. $yourID . '">watch profile</a>';
  
            ?>
            </tr>
            <?php
            }
        }
    }
    }
    }
?>
</table>
</form>

</body>
</html>
