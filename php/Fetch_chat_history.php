<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    include_once(__DIR__ . "/../classes/Db.php"); 
    include_once(__DIR__ . "/../classes/Chat.php");
    $conn = Db::getConnection();

    session_start();
    $statement = $conn->query("SELECT `user_id` FROM user WHERE email = '".$_SESSION['email']."'");
    $statement->execute();
    $id = $statement->fetch(PDO::FETCH_COLUMN);
    $statement->execute();

    echo fetch_user_chat_history($id, $_POST['to_user_id'], $conn);
?>