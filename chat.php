<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    //klasse en database copy pasten naar hier
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/classes/Db.php");
   $conn = Db::getConnection(); 
    session_start();

    //var_dump($_SESSION['email']);
    $myID = $_SESSION['yourID'];
    //var_dump($myID);


    $yourID = $_GET['id'];
    $checkName = ("SELECT `firstname`, `lastname` FROM user WHERE user_id= '$yourID'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buddy Chat</title>
</head>
<body style= "font-family:arial; background-color:white;">

    <nav style="display:block; margin-left:auto; margin-right:auto; width:200px; text-align:center; color:blue;">
    <h1>BuddyChat</h1>
    <h5><a href="index.php">Terug</a></h5>
    </nav>




    <!--Chatbox-->
    <section class="chatbox" style=" background-color:white;  width : 600px; height:600px; display:block; margin: 0 auto; border-radius:20px;box-shadow: 0px 0px 24px -6px rgba(0,0,0,0.75);">

    <!--Buddy-->
    <div class="chattingWith" style=" width:600px; height:50px; background: linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%); margin: 0 auto; border-radius: 20px; padding-top:0.5px;">
        <h4 style="color:white; text-align:center;"><?php foreach ($conn->query($checkName) as $row){
        echo $row['firstname'] . " " . $row['lastname'];} ?></h4>
    </div>

    <!--Gesprek-->
    <div class="chatConversation" style=" background-color: gray;width:500px; height:460px; margin: 0 auto; margin-bottom:20px;">
    <?php 
            $conn = Db::getConnection();

            $statement = $conn->query("SELECT * FROM buddyChat");
            $statement->execute();

            if($statement->fetchColumn() > 0){
                while($row = $statement->fetch( PDO::FETCH_ASSOC )){
                    echo "" . $row["user_id"] . " " . ":: " . $row["message"] . " -- " . $row["time"] . "<br/>";
                    echo "<br/>";
                }
            } else {
                echo "0 results";
            }
        ?>

    </div>

    <!--Bericht-->

    <form action="send.php" method="POST">
    <div class="chatMessage" style=" width:520px; height:50px; background-color:#F9F9F9; margin: 0 auto; border-radius: 50px; bottom:0; position:inline; ">

    <textarea name="msg" id="msg" placeholder="Schrijf een bericht..." style=" resize:none;color:gray; padding-left:20px; padding-top:20px;width:360px; height:30px; background-color:#F9F9F9; margin: 0 auto; border-radius: 50px; border-color:none; border:outset 0px;" ></textarea>

        <!--Verzenden-->
        <div class="sendBtn"style="position:inline;  width:80px; height:30px; border-radius:50px; padding-left: 0px; padding-top:10px; padding-right:15px; float:right;">
        <button id="send" data-buddyChat="3"style="position:inline; background-color:#AADEFF; width:80px; height:30px; border-radius:50px;color:white; font-size:12px; border-color:#AADEFF;">Verzend</button>
        </div>   
    </div>
    </form>
    
    </section>

   <!-- <script src="chat.js"></script>-->

</body>
</html>

