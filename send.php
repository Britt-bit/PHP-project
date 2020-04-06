<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

session_start();

    $conn = Db::getConnection();

    //De huidige user ophalen
    $statement = $conn->query("SELECT `user_id` FROM user WHERE email = '".$_SESSION['email']."'");
    $statement->execute();
    $id = $statement->fetch(PDO::FETCH_COLUMN);
    $statement->execute();  


    $message=$_POST['msg'];

    //message in database zetten
    $stmt = $conn->query("INSERT INTO `buddyChat`(`user_id`, `message`) VALUES ('$id', '$message')");

    //puts the data a second time in database so don't use it here
    //$stmt->execute();
    header("Location:chat.php");
?>
