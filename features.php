<?php
session_start();
/* ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL); */

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
            <h4>Wat voor soort games speel je graag?</h4>
            <label for="games"></label>
            <select class="dropDown" id="games" name="games">
                <option value="shooter">Shooter</option>
                <option value="moba">MOBA</option>
                <option value="rpg">RPG</option>
                <option value="mmo">MMO</option>
                <option value="RTS">RTS</option>
                <option value="gezelchapspelletjes">Gezelschapspelletjes</option>
            </select>
  
            <h4>Wat vind je de leukste vakken in IMD?</h4>
            <label for="vak"></label>
            <select class="dropDown" id="vak" name="vak">
                <option value="development">Development</option>
                <option value="design">Design</option>
                <option value="entrepeneurship">Entrepreneurship</option>
                <option value="communicatie">Communicatie</option>
            </select>
            
            <h4>Welke films kijk je graag?</h4>
            <label for="film"></label>
            <select class="dropDown" id="film" name="film">
                <option value="actie">Actie</option>
                <option value="komedie">Komedie</option>
                <option value="horror">Horror</option>
                <option value="romantisch">Romantisch</option>
                <option value="thriller">Thriller</option>
                <option value="actie">Drama</option>
                <option value="komedie">Misdaad</option>
                <option value="horror">Scifi</option>
                <option value="romantisch">Fantasy</option>
            </select>
  
            <h4>Welke muziek luistert je graag?</h4>
            <label for="muziek"></label>
            <select class="dropDown" id="muziek" name="muziek">
                <option value="pop">Pop</option>
                <option value="klassiek">Klassiek</option>
                <option value="rap">Rap</option>
                <option value="r&b">R&B</option>
                <option value="hardstyle">Hardstyle</option>
                <option value="schlager">Schlager</option>
                <option value="pop">Heavy metal</option>
                <option value="klassiek">Jazz</option>
                <option value="allesSlecht">Niets van hierboven</option>
            </select>

            <h4>Wat is je hobby?</h4>
            <label for="hobby"></label><br>
            <input class="dropDown" type="text" id="hobby" name="hobby" value=""><br><br>

            <button type="submit" class="loginSettings btnSubmit">Vervolledig profiel</button>
            </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>
