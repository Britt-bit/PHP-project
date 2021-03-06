<?php
include_once(__DIR__ . "/Db.php");

class Request
{

    public function getRequest($id)
    {
        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT * FROM buddy WHERE buddy_id = :id OR seeker_id = :id ");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }

    public function getbuddyrequest()
    {
    }


    public function sendRequest($id, $uid)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO buddy (buddy_id, seeker_id, request) VALUES (:buddy_id, :seeker_id , 'yes')");
            $statement->bindParam(':buddy_id', $id);
            $statement->bindParam(':seeker_id', $uid);
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

            $statement = $conn->prepare("UPDATE buddy SET `accepted`= 'yes', `request`= 'no' WHERE `buddy_id`= $id AND`seeker_id`= $uid");
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

            $statement = $conn->prepare("UPDATE buddy SET `accepted`= 'no', `request`= 'no'  WHERE `buddy_id`= $id AND`seeker_id`= $uid OR `buddy_id`= $uid AND`seeker_id`= $id");
            $statement->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getseeker($id)
    {

        $conn = Db::getConnection();

        $statement = $conn->prepare("select user_id, firstname, lastname from user WHERE user_id in(SELECT seeker_id FROM buddy WHERE buddy_id = :id) LIMIT 1");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }

    public function getbuddy($id)
    {

        $conn = Db::getConnection();

        $statement = $conn->prepare("select user_id, firstname, lastname from user WHERE user_id in(SELECT buddy_id FROM buddy WHERE seeker_id = :id) LIMIT 1");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }
}
