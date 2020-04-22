<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include_once(__DIR__ . "/../classes/Db.php"); 
   include_once(__DIR__ . "/../classes/Chat.php");

   $conn = Db::getConnection();
   session_start();

$status = 1;

   $statement = $conn->query("SELECT `user_id` FROM user WHERE email = '".$_SESSION['email']."'");
    $statement->execute();
    $id = $statement->fetch(PDO::FETCH_COLUMN);
    $statement->execute();


   $statementChat = $conn->prepare("INSERT INTO buddyChat (to_user_id, from_user_id, chat_message, status) 
   VALUES (:to_user_id, :from_user_id, :chat_message, :status)");

   $statementChat->bindValue(":to_user_id", $_POST['to_user_id']);
   $statementChat->bindValue(":from_user_id", $id);
   $statementChat->bindValue(":chat_message", $_POST['chat_message']);
   $statementChat->bindValue(":status", $status);


    if($statementChat->execute()){
        echo fetch_user_chat_history($id, $_POST['to_user_id'], $conn);
    }
?>