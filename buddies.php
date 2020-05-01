<?php

//Include_once
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Match.php");

//connectie met databank
$conn = Db::getConnection();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/buddy.css">
    <link rel="stylesheet" href="./css/home.css">
    <title>My buddies</title>
</head>
<body>
<!--Logo-->
<a href="index.php"><img class="logo" src="./images/logo.png" alt="Buddiez logo"></a>

<!--navigatie-->
<nav>
    <a href="index.php?id=<?php $_SESSION['user_id'][0] ?>">Home</a>
    <a href="profile.php?id=<?php $_SESSION['user_id'][0] ?>">Profile</a>
    <a style="color: rgb(245, 134, 124);"href="buddies.php?id=<?php $_SESSION['user_id'][0] ?>">My buddies</a>
    <a href="match.php?id=<?php $_SESSION['email'] ?>">My matches</a>
    <a href="logout.php" class="logout">Logout</a>
    </nav>


<h1>My buddies</h1>

  <div class="buddyBox">
    
    <ul>
        <li><div class="buddy">

        <!--Hier komt buddy 1-->
            <div class="buddies" style=" border-radius: 20px;padding-top:20px;width: 290px;height: 100px;float:left;">
                <img src="images/profile.jpeg" alt="" style="width:90px; height:90px;border-radius:50%; margin-left:20px;">
                <h4 style="margin-top:35px; float:right;">Firstname Lastname</h4>
            </div>

            <h2 style="width:10px; margin-top:50px; color: rgb(169, 100, 209);float:left; margin-left:50px;">X</h2>

        </div></li>




    </ul>
    
  </div>

</body>
</html>