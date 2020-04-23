<?php

include_once(__DIR__ . "/Db.php");
include_once(__DIR__ . "/User.php");
    class feature{

        /**
         * Features
         */
        private $hobby;
        private $games;
        private $films;
        private $muziek;
        private $vak;

        /**
         * Get features
         */ 
        public function getHobby()
        {
                return $this->hobby;
        }

        /**
         * Set features
         *
         * @return  self
         */ 
        public function setHobby($hobby)
        {
                $this->hobby = $hobby;
                return $this;
        }

        /**
         * Get the value of games
         */ 
        public function getGames()
        {
                return $this->games;
        }

        /**
         * Set the value of games
         *
         * @return  self
         */ 
        public function setGames($games)
        {
                $this->games = $games;
                return $this;
        }

        /**
         * Get the value of films
         */ 
        public function getFilms()
        {
                return $this->films;
        }

        /**
         * Set the value of films
         *
         * @return  self
         */ 
        public function setFilms($films)
        {
                $this->films = $films;
                return $this;
        }

        /**
         * Get the value of muziek
         */ 
        public function getMuziek()
        {
                return $this->muziek;
        }

        /**
         * Set the value of muziek
         *
         * @return  self
         */ 
        public function setMuziek($muziek)
        {
                $this->muziek = $muziek;
                return $this;
        }

        /**
         * Get the value of vak
         */ 
        public function getVak()
        {
                return $this->vak;
        }

        /**
         * Set the value of vak
         *
         * @return  self
         */ 
        public function setVak($vak)
        {
                $this->vak = $vak;
                return $this;
        }

        public function insertFeatures(){
                $conn = Db::getConnection();
                $statement = $conn->prepare("SELECT user_id FROM user WHERE email = '".$_SESSION['email']."'");
                    $statement->execute();
                    $id = $statement->fetch(PDO::FETCH_COLUMN);
                    $statement = $conn->prepare("INSERT INTO features (user_id, games, films, muziek, vak, hobby) VALUES (:id, :games, :film, :muziek, :vak, :hobby)");

                    $hobby = $this->getHobby();
                    $games = $this->getGames();
                    $vak = $this->getVak();
                    $film = $this->getFilms();
                    $muziek = $this->getMuziek();

                    $statement->bindValue(":id", $id);
                    $statement->bindValue(":hobby", $hobby);
                    $statement->bindValue(":games", $games);
                    $statement->bindValue(":vak", $vak);
                    $statement->bindValue(":film", $film);
                    $statement->bindValue(":muziek", $muziek);
        
                    $statement->execute();
            }

        public static function hobby(){
                $conn = Db::getConnection();

                $statement = $conn->prepare("SELECT user_id FROM user WHERE email = '".$_SESSION['email']."'");
                $statement->execute();
                $id = $statement->fetch(PDO::FETCH_COLUMN);
            
                $statement = $conn->prepare("SELECT hobby FROM features WHERE user_id = :id");
                $statement->bindValue(":id", $id);
                $statement->execute();
                $hobby = $statement->fetchColumn();
                return $hobby;
        }

        public static function checkFeatures(){
                $conn = Db::getConnection();

                $statement = $conn->prepare("SELECT user_id FROM user WHERE email = '".$_SESSION['email']."'");
                $statement->execute();
                $id = $statement->fetch(PDO::FETCH_COLUMN);
                    
                $statement = $conn->prepare("SELECT games, films, muziek, vak FROM features WHERE user_id = :id");
                $statement->bindValue(":id", $id);
                $statement->execute();
                $checkFeatures = $statement->fetchColumn();
                return $checkFeatures;
        }

        public function insertHobby(){
                $conn = Db::getConnection();

                $statement = $conn->prepare("SELECT user_id FROM user WHERE email = '".$_SESSION['email']."'");
                $statement->execute();
                $id = $statement->fetch(PDO::FETCH_COLUMN);
                    
                $statement = $conn->prepare("UPDATE features set hobby= :hobby where user_id = :id");
                $hobby = $this->getHobby();
                $statement->bindValue(":id", $id);
                $statement->bindValue(":hobby", $hobby);
                    
                $statement->execute();
        }

        public function getFeaturesFromUser($id)
        {
                $conn = Db::getConnection();

                $statement = $conn->prepare("SELECT games, films, muziek, vak, hobby FROM features where user_id = :id");
                $statement->bindValue(":id", $id);

                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

    }