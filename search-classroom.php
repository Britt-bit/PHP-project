<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ ."/classes/Post.php");
include_once(__DIR__ . "/classes/Db.php");
$conn = Db::getConnection();

if ($_SESSION['email']  == '') {
    header ("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/classrooms.css">


    <title>Classrooms</title>


</head>
<body>


    <h2>Looking for classroom?</h2>
    <div class="lokaal-container">
        <?php
         if(isset($_POST['submit-search'])){
            $searchClassroom = substr($conn->quote($_POST['search']), 1, -1);

            $searchQuerry = Post::searchClassroom($searchClassroom);
            ?> 
            <table>
            <tr>
                <th>Classroom</th>
                <th>Campus</th>
                <th>Floor</th>
                <th>Extra</th>
            </tr>
            <?php
            while($row = $searchQuerry->fetch(PDO::FETCH_ASSOC)):?>
            <tr>
                <td><?php echo htmlspecialchars($row['classroom'])?></td>
                <td><?php echo htmlspecialchars($row['campus'])?></td>
                <td><?php echo htmlspecialchars($row['floor'])?></td>
                <td><?php echo htmlspecialchars($row['extra'])?></td>
            </tr>
           
            <?php endwhile; ?>
            </table>
         <?php }?>
        
    </div>
</body>
</html>