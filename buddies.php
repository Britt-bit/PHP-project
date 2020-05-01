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
    <link rel="stylesheet" href="./css/buddies.css">
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




  <div class="buddyBox">
  <h1>My buddies</h1>   

    <h4>
  

      <?php
          //Als je buddies hebt, komt deze in je lijst te staan
          $countUsers = User::countUsers();
          foreach($countUsers as $count) {
          echo "Buddies: $count ";
          echo "<br/>";
          echo "<br/>";
         //Eigen Username afdrukken
         echo 'username: ' . get_current_user();
         echo "<br/>";
         echo "<br/>";
        //Alle gebruikers afprinten
        }
        
      ?>  

        <?php
            $users = $statement->fetch(PDO::FETCH_ASSOC);

            $firstname = $users['firstname'];
            $lastname = $users['lastname'];

            echo "$firstname ";
            echo " $lastname";
            echo "<br/>";
            echo count($users);
            echo "<br/>";


        ?>




<?php

  for($i=0; $i<count($users); $i++)
  var_dump($firstname)


?>
      
    </h4>
    
  </div>








</body>
</html>