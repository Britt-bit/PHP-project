<?php

include_once(__DIR__ . "/Db.php");
    class User{
        private $firstname;
        private $lastname;
        private $email;
        private $avatar;
        private $bio;
        private $password;
        private $newpassword;

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
                throw new Exception("Firsname cannot be empty");
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
                throw new Exception("Lastname cannot be empty");
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
                throw new Exception("Email cannot be empty");
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
                throw new Exception("Password cannot be empty");
            }
                $this->password = $password;

                return $this;
        }



        /**
         * Get the value of avatar
         */ 
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         *
         * @return  self
         */ 
        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        /**
         * Get the value of bio
         */ 
        public function getBio()
        {
                return $this->bio;
        }

        /**
         * Set the value of bio
         *
         * @return  self
         */ 
        public function setBio($bio)
        {
                $this->bio = $bio;

                return $this;
        }

         /**
         * Get the value of newpassword
         */ 
        public function getNewpassword()
        {
                return $this->newpassword;
        }

        /**
         * Set the value of newpassword
         *
         * @return  self
         */ 
        public function setNewpassword($newpassword)
        {
                $this->newpassword = $newpassword;

                return $this;
        }


        public function saveUser(){
            $conn = Db::getConnection();

            $statement = $conn->prepare("insert into user (firstname, lastname, email, password, avatar, bio) values (:firstname, :lastname, :email, :password, :avatar, :bio)");

            $firstname = $this->getFirstname();
            $lastname = $this->getLastname();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $avatar = $this->getAvatar();
            $bio = $this->getBio();

            $statement->bindValue(":firstname", $firstname);
            $statement->bindValue(":lastname", $lastname);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":avatar", $avatar);
            $statement->bindValue(":bio", $bio);

            $result = $statement->execute();

            return $result;
        }

        

        public static function getAllUsers(){
            $conn = Db::getConnection();
            
            $statement = $conn->prepare("select * from user");
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }

        public function emailValidation(){
            $email = $this->getEmail();
            $conn = Db::getConnection();

            $check_email = ("SELECT email FROM user WHERE email='$email'");

            foreach ($conn->query($check_email) as $row){
                print $row['email'];
            }
            return $row;
        }
        /* update user */
        function getUserById($id){
            $conn = Db::getConnection();
            $statement = $conn->prepare('select * from user where user_id = :id');
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }
        function updateUser()
        {
               if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $this->avatar)) {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare("update user set firstname= :firstname, lastname= :lastname, email= :email, avatar= :avatar, bio= :bio");
                    $statement->bindParam(":firstname", $this->firstname);
                    $statement->bindParam(":lastname", $this->lastname);
                    $statement->bindParam(":email", $this->email);
                    $statement->bindParam(":avatar", $this->avatar);
                    $statement->bindParam(":bio", $this->bio);

                    $statement->execute();
               }else {
                    $conn = Db::getConnection();
                    $statement = $conn->prepare("update user set firstname= :firstname, lastname= :lastname, email= :email, bio= :bio");
                    $statement->bindParam(":firstname", $this->firstname);
                    $statement->bindParam(":lastname", $this->lastname);
                    $statement->bindParam(":email", $this->email);
                    $statement->bindParam(":bio", $this->bio);

                    $statement->execute();
               }
            
        }
        function updatePassword()
        {
            
            $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE user SET password= :password");
            $statement->bindParam(":password", $this->newpassword);

            $statement->execute();
        }
        function passwordCheck($id, $password)
        {
            $user = self::getUserById($id);

            if ($password == $user['password']) {
                return true;
            }
            else{
                return false;
            }
            
        }

        public function passwordHash($password){

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ["cost" => 12]);
            return $password;
        }
    }
