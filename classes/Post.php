<?php

class Post{
    public static function search($search)
    {

        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT user_id FROM user WHERE email = :email ");
        $statement->bindValue(":email", $_SESSION['email']);
        $statement->execute();
        $id = $statement->fetch(PDO::FETCH_COLUMN);
        
        
        $statement = $conn->prepare("SELECT user.user_id, firstname, lastname, avatar, email, games, films, muziek, vak, hobby FROM user
        INNER JOIN features on user.user_id=features.user_id WHERE 
        (CONCAT(firstname, ' ', lastname) LIKE :search
        OR firstname like :search 
        OR lastname like :search 
        OR games like :search  
        OR films like :search
        OR muziek like :search
        OR vak like :search
        OR hobby like :search)
        AND user.user_id != :id 
        ");
        $statement->bindValue(":id", $id);
        $statement->bindValue(":search",'%'.$search.'%');
        $statement->execute();
        $search = $statement->fetchAll();

        return $search;
    }

    public static function searchClassroom($searchClassroom){
        $conn = Db::getConnection();
        $searchQuerry = $conn->prepare("SELECT * FROM `finder` WHERE classroom LIKE :search OR campus LIKE :search"); //or die($mysqli->error);
        $searchQuerry->bindValue(":search", '%'.$searchClassroom.'%');
        $searchQuerry->execute();
        return $searchQuerry;
    }

}

?>