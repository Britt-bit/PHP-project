<?php

include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");



//Check of we al buddies zijn *
//Buddyrequester *
//Buddyreceiver *
//Is request al verzonden geweest? *
//Request verzenden *
//Cancel request *
//Buddies maken *
//Buddies verwijderen *
//Request notification *


class buddies{
    public function myBuddies($u_id){
        $conn = Db::getConnection();

        $statement = $conn->prepare
        ("SELECT user_id, firstname, lastname FROM user
          JOIN (SELECT buddy_id as user_id FROM buddy WHERE seeker_id = :id
          AND accepted = 1
          UNION
          SELECT seeker_id as user_id FROM buddy WHERE buddy_id = :id 
          AND accepted = 1") ;

        $statement->bindValue(":id", $u_id);
        if ($statement->rowCount()>0){
        $buddies = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $buddies;

        }
    }


}




?>