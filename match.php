<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");
include_once(__DIR__ ."/classes/Match.php");

if(isset($_GET['chat'])){
    $id = $_GET['chat'];
    
    $result = $mysqli->query("SELECT * FROM user WHERE user_id=$id") or die($mysqli->error());
    if (count($result) ==1){
        $row = $result->fetch_array();
        //var_dump($id);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches</title>
</head>
<body>

    <h1>My matches</h1>
    <form method="post">
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

                $stmt = $conn->query("SELECT `user_id` FROM `user` WHERE email = '$yourEmail'");
                $stmt->execute();
                $yourID = $stmt->fetch(PDO::FETCH_COLUMN);

                //al deze features in een 2de array zetten
                $yourFeatureArray = array($yourGame, $yourFilm, $yourMusic, $yourCourse, $yourHobby);

                //De 2 arrays vergelijken om te zien welke features allemaal matchen.
                $result = array_intersect($myFeatures, $yourFeatureArray);
            
                //als er 5 dezelfde features zijn ... 
                if(count($result) === 5){
                    echo "<br/>";
                    print("You matched with " . $yourName . " " . $yourLastname . " on the features "); 
                        for($tel = 0; $tel < sizeof($result); ++$tel){
                            if($tel < sizeof($result) -1){
                                echo($result[$tel] . ", ");
                            } else {
                                echo($result[$tel] . ".");
                            }
                        }
                    echo '<a href="chat.php?chat=' . $yourID . '">Chat</a>'
                ?>
            </tr>
            <?php
                }else if(count($result) === 4){
                    echo "<br/>";
                    print("You matched with " . $yourName . " " . $yourLastname . " on the features "); 
                    for($tel = 0; $tel < sizeof($result) +2; ++$tel){
                        echo($result[$tel] . "  ");
                    }
                echo '<a href="chat.php?chat=' . $yourID . '">Chat</a>'
            ?>
            </tr>
            <?php
                } else if(count($result) === 3){
                    echo "<br/>";
                    print("You matched with " . $yourName . " " . $yourLastname . " on the features "); 
                    for($tel = 0; $tel < sizeof($result) +2; ++$tel){
                        echo($result[$tel] . "  ");   
                    }
                echo '<a href="chat.php?chat=' . $yourID . '">Chat</a>'
            ?>
            </tr>
            <?php
            }
        }
    }
?>
</table>
</form>

</body>
</html>
