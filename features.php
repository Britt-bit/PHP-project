<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

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
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container register-form">
        <div class="note">
            <p>Kenmerken</p>
                
        </div>

        <form action="index.php" method="post">
  
 
            <h4>Wat voor soort games speelt u graag?</h4>
            <label for="games"></label>
            <select id="games" name="games">
                <option value="shooter">Shooter</option>
                <option value="moba">MOBA</option>
                <option value="rpg">RPG</option>
                <option value="mmo">MMO</option>
            </select>
  
            <h4>Wat vind je de leukste vakken in IMD?</h4>
            <label for="vak"></label>
            <select id="vak" name="vak">
                <option value="development">Development</option>
                <option value="design">Design</option>
                <option value="entrepeneurship">Entrepreneurship</option>
                <option value="communicatie">Communicatie</option>
            </select>
            
            <h4>Welke films kijk je graag?</h4>
            <label for="film"></label>
            <select id="film" name="film">
                <option value="actie">Actie</option>
                <option value="komedie">Komedie</option>
                <option value="horror">Horror</option>
                <option value="romantisch">romantisch</option>
                <option value="thriller">Thriller muziek</option>
            </select>
  
            <h4>Welke muziek luistert u graag?</h4>
            <label for="muziek"></label>
            <select id="muziek" name="muziek">
                <option value="pop">Pop</option>
                <option value="klassiek">Klassiek</option>
                <option value="rap">Rap</option>
                <option value="r&b">R&B</option>
                <option value="hardstyle">Hardstyle</option>
                <option value="schlager">Schlager</option>
                <option value="allesSlecht">De hierboven genoemde muziek is allemaal slecht</option>
            </select>


            <h4>wat is je hobby?</h4>
            <label for="hobby"></label><br>
            <input type="text" id="hobby" name="hobby" value=""><br><br>

            <input type="submit">
            </form>

    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
