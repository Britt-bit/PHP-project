<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   include_once(__DIR__ . "/../classes/Db.php"); 
   include_once(__DIR__ . "/../classes/Chat.php");

   $conn = Db::getConnection();
   session_start();

   //$query = "SELECT * FROM buddyChat WHERE (from_user_id = '".$from_user_id."' 
   //AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' 
   //AND to_user_id = '".$from_user_id."') ORDER BY timestamp DESC";
   //$statementChat = $conn->prepare($query);
   //$statementChat->execute();
   //$result = $statementChat->fetchAll();

   //var_dump($result);



   $data_reaction = $_POST['data_reaction'];
   $message_id = $_POST['message_id'];
    $stmtReaction = $conn->prepare("UPDATE `buddyChat` SET `reaction_id`= $data_reaction WHERE `chat_message_id` = $message_id");
    //$stmtReaction->bindValue(":reaction_id", $_POST['data_reaction']);
    $stmtReaction->execute();
    
?>