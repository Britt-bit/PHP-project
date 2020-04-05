<?php

include_once(__DIR__ . "/Db.php");
include_once(__DIR__ . "/User.php");

class chat{
    private $user;
    private $buddy;
    private $message;
    private $time;
    

    /**
     * Get the value of user
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of buddy
     */ 
    public function getBuddy()
    {
        return $this->buddy;
    }

    /**
     * Set the value of buddy
     *
     * @return  self
     */ 
    public function setBuddy($buddy)
    {
        $this->buddy = $buddy;

        return $this;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */ 
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    public function saveMessage(){

        $conn = new PDO("mysql:host=localhost;dbname=phpProject", "root", "root");
       // $conn = Db::getConnection();
        $statement = $conn->prepare("insert into buddyChat (buddy_id, user_id, message, time) values (:buddy_id, :user_id, :message, :timestamp)");

        $user = $this->getUser_id();
        $buddy = $this->getBuddy_id();
        $message = $this->getMessage();
        $time = $this->getTimestamp();


        $statement->bindValue(":user_id", $user);
        $statement->bindValue(":buddy_id", $buddy);
        $statement->bindValue(":message", $message);
        $statement->bindValue(":timestamp", $time);

        $result = $statement->execute();

        return $result;

    }
}



?>