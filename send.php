<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

session_start();

    $conn = Db::getConnection(); 

    //werkt nog niet
    session_start();
    $yourID = $_GET['id'];

    //De huidige user ophalen
    $statement = $conn->query("SELECT `user_id` FROM user WHERE email = '".$_SESSION['email']."'");
    $statement->execute();
    $id = $statement->fetch(PDO::FETCH_COLUMN);
    $statement->execute();  


    $message=$_POST['msg'];

    //message in database zetten

    //puts the data a second time in database so don't use it here
    //$stmt->execute();
    


    $stmt = $conn->prepare("INSERT INTO buddyChat (`user_id`, `message`) VALUES (:user_id, :message)");

    $stmt->bindValue(":user_id", $id);
    $stmt->bindValue(":message", $message);

    $result = $stmt->execute();

    header("Location:chat.php?id=$yourID");
?>