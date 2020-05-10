<?php
session_start();
/* ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL); */

if ($_SESSION['email']  == '') {
    header ("Location: login.php");
}

    include_once(__DIR__ ."/classes/User.php");
    include_once(__DIR__ ."/classes/Features.class.php");
    include_once(__DIR__ ."/classes/Db.php");

    //insert features
    //htmlspecialchar
    if(!empty($_POST)){
        $feature = new feature();
        $feature->setGames($_POST['games']);
        $feature->setFilms($_POST['film']);
        $feature->setMuziek($_POST['muziek']);
        $feature->setVak($_POST['vak']);
        $feature->setHobby($_POST['hobby']);

        $feature->insertFeatures();
        header("Location: index.php");
    }

    //indien al ingevuld, niet meer naar deze pagina.
    $checkFeatures = feature::checkFeatures();
    
        if ($checkFeatures == true){
        //echo"features nog niet ingevuld";
        header("Location: index.php");
        

            

        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/features.css">   
    <title>Features</title>
</head>
<body>

    <div class="features">

    <img class="logo" src="./images/logo.png" alt="Buddiez logo">
        <div class="note">
            <h1 style="font-size:30px; margin-top:-50px;">Kenmerken</h1>  
        </div>

        <form action="" method="post">
            <h4>What kind of games do you like??</h4>
            <label for="games"></label>
            <select class="dropDown" id="games" name="games">
                <option value="shooter">Shooter</option>
                <option value="moba">MOBA</option>
                <option value="rpg">RPG</option>
                <option value="mmo">MMO</option>
                <option value="RTS">RTS</option>
                <option value="gezelchapspelletjes">Board games</option>
            </select>
  
            <h4>What do you like most in IMD?</h4>
            <label for="vak"></label>
            <select class="dropDown" id="vak" name="vak">
                <option value="development">Development</option>
                <option value="design">Design</option>
                <option value="entrepeneurship">Entrepreneurship</option>
                <option value="communicatie">Communication</option>
            </select>
            
            <h4>What movies do you like?</h4>
            <label for="film"></label>
            <select class="dropDown" id="film" name="film">
                <option value="actie">Action</option>
                <option value="komedie">Comedy</option>
                <option value="horror">Horror</option>
                <option value="romantisch">Romantic</option>
                <option value="thriller">Thriller</option>
                <option value="drama">Drama</option>
                <option value="misdaad">Crime</option>
                <option value="scifi">Scifi</option>
                <option value="fantasy">Fantasy</option>
            </select>
  
            <h4>What music do you like?</h4>
            <label for="muziek"></label>
            <select class="dropDown" id="muziek" name="muziek">
                <option value="pop">Pop</option>
                <option value="klassiek">Classic</option>
                <option value="rap">Rap</option>
                <option value="r&b">R&B</option>
                <option value="hardstyle">Hardstyle</option>
                <option value="schlager">Schlager</option>
                <option value="heavy metal">Heavy metal</option>
                <option value="jazz">Jazz</option>
                <option value="allesSlecht">Nothing</option>
            </select>

            <h4>What is your hobby?</h4>
            <label for="hobby"></label><br>
            <input class="dropDown" type="text" id="hobby" name="hobby" value=""><br><br>
            <div id="hobbyCount" ></div>

            <button type="submit" class="loginSettings btnSubmit">Complete profile</button>
            </form>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/sameHobby.js"></script>
</body>
</html>

