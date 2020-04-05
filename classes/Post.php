<?php

class Post{
    public static function search($search)
    {

        
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT firstname, lastname, avatar, games, films, muziek, vak, hobby FROM user
        INNER JOIN features on user.user_id=features.user_id WHERE 
        firstname like :search 
        OR lastname like :search 
        OR games like :search  
        OR films like :search
        OR muziek like :search
        OR vak like :search
        OR hobby like :search
        ");

        $statement->bindValue(":search", $search);
        $statement->execute();
        $search = $statement->fetchAll();

        return $search;
    }

}

?>

