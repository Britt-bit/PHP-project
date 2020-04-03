<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

    include_once(__DIR__ ."/classes/User.php");
    include_once(__DIR__ ."/classes/Features.class.php");
    include_once(__DIR__ ."/classes/Db.php");

    // Check connection

    /* get user */

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

        <form action="" method="post">



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