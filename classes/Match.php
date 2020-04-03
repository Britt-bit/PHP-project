<?php 
include_once(__DIR__ . "/Db.php");
include_once(__DIR__ . "/User.php");
include_once(__DIR__ . "/Features.class.php");
    class Match {


      public function getAllFeatures(){
        $conn = Db::getConnection();
      
      $statement = $conn->query("SELECT `user_id` FROM user WHERE email = '".$_SESSION['email']."'");
      $statement->execute();
      $id = $statement->fetch(PDO::FETCH_COLUMN);
      $statement->execute();
      
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
      return $myFeatures = array($game, $film, $muziek, $vak, $hobby, $user_id);

      }

      public function compareMatch(){
        $conn = Db::getConnection();
        

        $statement = $conn->query("SELECT `games`, `films`, `muziek`, `vak`, `hobby`, `firstname`, `lastname` FROM `features`, `user` WHERE features.user_id = user.user_id");
        $statement->execute();

        $myFeatures = self::getAllFeatures();
        var_dump($myFeatures);

        while($yourFeature = $statement->fetch( PDO::FETCH_ASSOC )){ 
          
           // echo $yourFeature['games'].  "<br/>"; 
           // echo $yourFeature['films'].  "<br/>";
           // echo $yourFeature['muziek'].  "<br/>"; 
           // echo $yourFeature['vak'].  "<br/>";
           // echo $yourFeature['hobby'].  "<br/>"; 
           // echo $yourFeature['user_id'].  "<br/>";
           //$id = $yourFeature['user_id'];

            for ($counter = 0; $yourFeature = $statement->fetch( PDO::FETCH_ASSOC ); ++$counter){
              if($yourFeature['games'] == $myFeatures[0] && $yourFeature['films'] == $myFeatures[1]){
                
                print("You matched with " . $yourFeature['firstname'] . " " . $yourFeature['lastname'] . " on the game " . $yourFeature['games'] . " and on films with " . $yourFeature['films'] . "<br/>");
              }else if($yourFeature['games'] == $myFeatures[0]){
                print("You matched with " . $yourFeature['firstname'] . " " . $yourFeature['lastname'] .  " on games" . "<br/>");
              }
            }
        }

        
        
          
        
      }


    }

?>

