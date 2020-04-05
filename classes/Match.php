<?php 
include_once(__DIR__ . "/Db.php");

    $conn = Db::getConnection();

    //De huidige user ophalen
    $statement = $conn->query("SELECT `user_id` FROM user WHERE email = '".$_SESSION['email']."'");
    $statement->execute();
    $id = $statement->fetch(PDO::FETCH_COLUMN);
    $statement->execute();

    //Features van de huidige user ophalen
    $getFeatures = $conn->prepare("SELECT * FROM features WHERE user_id = '$id'");
    $getFeatures->execute();

    while($myFeature = $getFeatures->fetch( PDO::FETCH_ASSOC )){ 
        $game = $myFeature['games']; 
        $film = $myFeature['films'];
        $muziek = $myFeature['muziek']; 
        $vak = $myFeature['vak'];
        $hobby = $myFeature['hobby']; 
        $user_id = $myFeature['user_id'];
    }

    //alle features in een array zetten
    $myFeatures = array($game, $film, $muziek, $vak, $hobby);

    //features van alle andere gebruikers ophalen
    $statement = $conn->query("SELECT `games`, `films`, `muziek`, `vak`, `hobby`, `firstname`, `lastname`, `email` FROM `features`, `user` WHERE features.user_id = user.user_id");
    $statement->execute();
?>