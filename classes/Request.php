<?php
include_once(__DIR__ . "/Db.php");

class Request
{

    public function getRequest($id, $uid)
    {
        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT * FROM buddy WHERE buddy_id = :id AND seeker_id = :uid OR buddy_id = :uid AND seeker_id = :id ");
        $statement->bindParam(':id', $uid);
        $statement->bindParam(':uid', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }


    public function sendRequest($id, $uid)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO buddy (buddy_id, seeker_id, request) VALUES (:buddy_id, :seeker_id , 1)");
            $statement->bindValue(':buddy_id', $id);
            $statement->bindValue(':seeker_id', $uid);
            $statement->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function AcceptRequest($id, $uid)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("UPDATE buddy SET `accepted`= 1, `request`= 0 WHERE `buddy_id`= $uid AND`seeker_id`= $id OR `buddy_id`= $id AND`seeker_id`= $uid");
            $statement->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function DeleteRequest($id, $uid)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("UPDATE buddy SET `accepted`= 0, `request`= 0  WHERE `buddy_id`= $uid AND`seeker_id`= $id OR `buddy_id`= $id AND`seeker_id`= $uid");
            $statement->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
