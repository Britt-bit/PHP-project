<?php

include_once(__DIR__ . "/Db.php");
    class User{
        private $firstname;
        private $lastname;
        private $email;
        private $password;

        /**
         * Get the value of firstname
         */ 
        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 
        public function setFirstname($firstname)
        {
            if(empty($firstname)){
                throw new Exception("firsname cannot be empty");
            }
                $this->firstname = $firstname;

                return $this;
        }

        /**
         * Get the value of lastname
         */ 
        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 
        public function setLastname($lastname)
        {
            if(empty($lastname)){
                throw new Exception("lastname cannot be empty");
            }
                $this->lastname = $lastname;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
            if(empty($email)){
                throw new Exception("email moet eindigen op @student.thomasmore.be");
            }
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
            if(empty($password)){
                throw new Exception("password cannot be empty");
            }
                $this->password = $password;

                return $this;
        }


        public function save(){
            $conn = Db::getConnection();

            $statement = $conn->prepare("insert into user (firstname, lastname, email, password) values (:firstname, :lastname, :email, :password)");

            $firstname = $this->getFirstname();
            $lastname = $this->getLastname();
            $email = $this->getEmail();
            $password = $this->getPassword();

            $statement->bindValue(":firstname", $firstname);
            $statement->bindValue(":lastname", $lastname);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);

            $result = $statement->execute();

            return $result;
        }

        

        public static function getAll(){
            $conn = Db::getConnection();

            $statement = $conn->prepare("select * from user");
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }
    }
?>