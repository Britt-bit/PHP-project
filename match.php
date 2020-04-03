<?php
session_start();
//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");
include_once(__DIR__ ."/classes/Match.php");


error_reporting(E_ALL);
ini_set('display_errors', 1);


$feature = new Match();
$feature->getAllFeatures();

$feature->compareMatch();




$connect = mysqli_connect("localhost", "root", "root", "phpProject");

$sql = "SELECT * FROM features INNER JOIN user ON features.user_id = user.user_id";
$result = mysqli_query($connect, $sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches</title>
</head>
<body>

    <h1>My matches</h1>

    <table>
        <?php 
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_array($result)){
        ?>
        <tr>
            <td><?php echo $row["games"]; ?></td>
            <td><?php echo $row["films"]; ?></td>
            <td><?php echo $row["muziek"]; ?></td>
            <td><?php echo $row["vak"]; ?></td>
            <td><?php echo $row["hobby"]; ?></td>
        </tr>    
        <?php        
            }
        }
        ?>
    </table>
 
</body>
</html>