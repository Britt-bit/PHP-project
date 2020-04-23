<?php

//Include_once
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");
include_once(__DIR__ ."/classes/Match.php");


//connectie met databank

$conn = Db::getConnection();

$getBuddies = $conn->prepare("SELECT * FROM user WHERE buddy= 2");

$getBuddies->execute();

var_dump ($getBuddies);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/buddy.css">
    <title>My buddies</title>
</head>
<body>

<a href="index.php">Home</a>
<h1>Buddies #2020</h1>

  <div class="buddyBox">
    
    <ul>
        <li><div class="buddy">

        <!--Hier komt buddy 1-->
            <div class="buddies" style=" border-radius: 20px;padding-top:20px;width: 290px;height: 100px;float:left;">
                <img src="images/profile.jpeg" alt="" style="width:90px; height:90px;border-radius:50%; margin-left:20px;">
                <h4 style="margin-top:35px; float:right;">Firstname Lastname</h4>
            </div>

            <h2 style="width:10px; margin-top:50px; color: rgb(169, 100, 209);float:left; margin-left:50px;">X</h2>

          <!--Hier komt buddy 2-->      
            <div class="buddies" style=" border-radius: 20px;padding-top:20px;width: 290px;height: 100px; float:right;">
                <h4 style="margin-top:35px; float:left;">Firstname Lastname</h4>
                <img src="images/profile.jpeg" alt="" style="width:90px; height:90px;border-radius:50%; margin-right:20px;float:right;">
            </div>

        </div></li>


        <li><div class="buddy"></div></li>
        <li><div class="buddy"></div></li>
        <li><div class="buddy"></div></li>
        <li><div class="buddy"></div></li>

    </ul>
    
  </div>

</body>
</html>