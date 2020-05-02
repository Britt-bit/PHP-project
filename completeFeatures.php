<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors',1);
error_reporting(E_ALL);

    include_once(__DIR__ ."/classes/User.php");
    include_once(__DIR__ ."/classes/Features.class.php");
    include_once(__DIR__ ."/classes/Db.php");

    // Check connection
    // get user
    //insert features
    if(!empty($_POST)){
        $feature = new feature();
        $feature->setHobby($_POST['hobby']);

        $feature->insertHobby();
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="vervolledigHobby">

        <form action="" method="post">
            <label for="hobby">Je hebt je hobby not niet ingevuld. Doe dit hier om je profiel te vervolledigen.</label><br>
            <input type="text" id="hobby" name="hobby" value=""><input type="submit" value="vervolledig profiel">

        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>
