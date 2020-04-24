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
        private $buddy;
        private $year;
        private $verified;
        private $vkey;

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
         * Get the value of password
         */ 
        public function getYear()
        {
                return $this->year;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */ 
        public function setYear($year)
        {
            if(empty($year)){
                throw new Exception("Year cannot be empty");
            }
                $this->year = $year;

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


        /**
         * Get the value of verified
         */ 
        public function getVerified()
        {
                return $this->verified;
        }

        /**
         * Set the value of verified
         *
         * @return  self
         */ 
        public function setVerified($verified)
        {
            if(empty($verified)){
                throw new Exception("You must be verified");
            }
                $this->verified = $verified;

                return $this;
        }



        public function saveUser(){
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO user (firstname, lastname, email, password, avatar, bio, school_year, buddy, vkey) VALUES (:firstname, :lastname, :email, :password, :avatar, :bio, :schoolyear, :buddy, :vkey)");

            $firstname = $this->getFirstname();
            $lastname = $this->getLastname();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $avatar = $this->getAvatar();
            $bio = $this->getBio();
            $year = $this->getYear();
            $buddy = $this->getBuddy();
            $vkey = $this->getVkey();

            $statement->bindValue(":firstname", $firstname);
            $statement->bindValue(":lastname", $lastname);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":avatar", $avatar);
            $statement->bindValue(":bio", $bio);
            $statement->bindValue(":schoolyear", $year);
            $statement->bindValue(":buddy", $buddy);
            $statement->bindValue(":vkey", $vkey);

            $result = $statement->execute();

            return $result;
        }

        

        public static function getAllUsers(){
            $conn = Db::getConnection();
            
            $statement = $conn->prepare("SELECT * FROM user");
            $statement->execute();
            $users = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $users;
        }

        public function emailValidation(){
            $email = $this->getEmail();
            $conn = Db::getConnection();

            $check_email = $conn->prepare("SELECT email FROM user WHERE email=':email'");
            $check_email->bindParam(':email', $email);
            
            foreach ($conn->query($check_email) as $row){
                print $row['email'];
            }
            return $row;
        }
        
        /* update user */
        function getUserById($id){
            $conn = Db::getConnection();
            $statement = $conn->prepare('SELECT * FROM user WHERE user_id = :id');
            $statement->bindParam(':id', $id);
            $statement->execute();
            $result = $statement->fetch();
            return $result;
        }

        function updateUser($id)
        {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $this->avatar)) {
                $conn = Db::getConnection();
                $statement = $conn->prepare("UPDATE user SET firstname= :firstname, lastname= :lastname, email= :email, school_year= :schoolyear, buddy= :buddy, avatar= :avatar, bio= :bio WHERE user_id= :id");
                $statement->bindParam(":firstname", $this->firstname);
                $statement->bindParam(":lastname", $this->lastname);
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":avatar", $this->avatar);
                $statement->bindParam(":bio", $this->bio);
                $statement->bindParam(":schoolyear", $this->year);
                $statement->bindParam(":buddy", $this->buddy);
                $statement->bindParam(":id", $id);
                
                $statement->execute();
            }else {
                $conn = Db::getConnection();
                $statement = $conn->prepare("UPDATE user SET firstname= :firstname, lastname= :lastname, email= :email, school_year= :schoolyear, buddy= :buddy, bio= :bio WHERE user_id= :id");
                $statement->bindParam(":firstname", $this->firstname);
                $statement->bindParam(":lastname", $this->lastname);
                $statement->bindParam(":email", $this->email);
                $statement->bindParam(":bio", $this->bio);
                $statement->bindParam(":schoolyear", $this->year);
                $statement->bindParam(":buddy", $this->buddy);
                $statement->bindParam(":id", $id);

                $statement->execute();
            }  
        }
        function updatePassword($id)
        {
           try {
                  $conn = Db::getConnection();
            $statement = $conn->prepare("UPDATE user SET password= :password where user_id= :id ");
            $statement->bindParam(":password", $this->newpassword);
            $statement->bindParam(":id", $id);

            $statement->execute();
           } catch (\Throwable $th) {
                   //throw $th;
           } 
            
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

        function usernameCheck($email)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare("select * from user where email = :email limit 1");
            $statement->bindValue(":email", $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if(empty($result)){
                    return true;
            }else{
                    return false;
            }
        }

        function loggedInUsername($row) { 
            $conn = Db::getConnection();
            $sql = $conn->prepare("SELECT firstname, lastname FROM user WHERE user_id = :id");
            $stmt = $conn->prepare($sql); // prepare the query
            $stmt->bindParam(':id', $_SESSION['user_id']); // assign the parameter
            $result = $stmt->execute(); // execute the query
            $row = $result->fetchColumn(); // only one column produced by query
            return $row;
          }


        public function passwordHash($password){

            $password = password_hash($_POST['password'], PASSWORD_DEFAULT, ["cost" => 12]);
            return $password;
        }


        /**
         * Get the value of vkey
         */ 
        public function getVkey()
        {
                return $this->vkey;
        }

        /**
         * Set the value of vkey
         *
         * @return  self
         */ 
        public function setVkey($vkey)
        {
                $this->vkey = $vkey;

                return $this;
        }
    }
