<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ . "/Db.php");
$conn = Db::getConnection();


function emoji($reactionID, $chatMessageID, $conn){

$qry = $conn->prepare("SELECT `name` FROM `buddyChat`, `reaction` WHERE buddyChat.reaction_id = reaction.reaction_id AND buddyChat.reaction_id = :name");
$qry->bindParam(':name', $reactionID);
$qry->execute();
$emoji = $qry->fetch(PDO::FETCH_COLUMN);

    if($reactionID == 0){
        $finalEmoji = '
        <div class="reaction-container reaction'.$reactionID.'">
            <span class="like-btn">
            <span class="like-btn-emo"><img src="data:image/png;base64,'.base64_encode($emoji) .'"></span>
                <ul class="reactions-box">
                    <li class="reaction reaction-1" message_id="'.$chatMessageID.'" data_reaction="1"></li>
                    <li class="reaction reaction-2" message_id="'.$chatMessageID.'" data_reaction="2"></li>
                    <li class="reaction reaction-3" message_id="'.$chatMessageID.'" data_reaction="3"></li>
                    <li class="reaction reaction-4" message_id="'.$chatMessageID.'" data_reaction="4"></li>
                    <li class="reaction reaction-5" message_id="'.$chatMessageID.'" data_reaction="5"></li>
                    <li class="reaction reaction-6" message_id="'.$chatMessageID.'" data_reaction="6"></li>
                </ul>
            </span>
           ' .//<div class="like-stat">
             //   <span class="like-emo">
             //       <span class="like-btn-like"></span>
             //   </span>
            //</div>
        ' </div>';
        //$finalEmoji = '<style> .facebook-reaction .reaction'.$reactionID.'{display: none;} </style>';
    } else {
        $finalEmoji = '<img src="data:image/png;base64,'.base64_encode($emoji) .'" style="width:20px;height:20px;>'; 
    }
    return $finalEmoji;
}



function fetch_user_chat_history($from_user_id, $to_user_id, $conn){
 $query = "SELECT * FROM buddyChat WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') ORDER BY timestamp DESC";
 $statementChat = $conn->prepare($query);
 $statementChat->execute();
 $result = $statementChat->fetchAll();
 
 
 $output = '<ul class="list-unstyled">';
 foreach($result as $row){
    
     
    //var_dump($numberOfUserData);
    //$numberOfUser = array_column($result, 'chat_message_id');
    

    $chatMessageID = $row['chat_message_id'];
    $reactionID = $row['reaction_id'];

  $firstname = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $firstname = '<b class="text-success">You</b>';
  }
  else
  {
   $firstname = '<b class="text-danger">'.get_user_name($row['from_user_id'], $conn).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$firstname.' - '.$row["chat_message"]. '
   
   <div class="left" align="left">

   '. emoji($reactionID, $chatMessageID, $conn).'
   

   </div>

    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
  
 }
 
 $output .= '</ul>';
 $query = "UPDATE buddyChat 
 SET status = '0' 
 WHERE from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."' 
 AND status = '1'
 ";
 $statement = $conn->prepare($query);
 $statement->execute();
 return $output;
}

function get_user_name($user_id, $conn)
{
 $query = "SELECT firstname FROM user WHERE user_id = '$user_id'";
 $statementChat = $conn->prepare($query);
 $statementChat->execute();
 $result = $statementChat->fetchAll();
 foreach($result as $row)
 {
  return $row['firstname'];
 }
}


function count_unseen_message($from_user_id, $to_user_id, $conn)
{
 $query = "SELECT * FROM buddyChat 
 WHERE from_user_id = '$from_user_id' 
 AND to_user_id = '$to_user_id' 
 AND status = '1'
 ";
 $statement = $conn->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}
?>



