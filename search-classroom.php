<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//include_once(__DIR__ . "/classes/Finder.php");
include_once(__DIR__ . "/classes/Db.php");
$conn = Db::getConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Search page</h1>
    <div class="lokaal-container">
        <?php
            if(isset($_POST['submit-search'])){
                //$search = PDO::quote($_POST['search']);
                $search = substr($conn->quote($_POST['search']), 1, -1);
                //$search = mysqli_real_escape_string($conn, $_POST['search']);

                $statement = $conn->prepare("SELECT * FROM `finder` WHERE classroom LIKE '%$search%' OR campus LIKE '%$search%'");
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_COLUMN);


                //$queryResults = mysqli_num_rows($result);
                var_dump($statement);
                var_dump($result);

                if($result > 0){
                   
                    while($row = $statement->fetch( PDO::FETCH_ASSOC)){
                        var_dump($row);
                        //var_dump($row);
                        echo "<div>
                            <h3>".$row['classroom']."</h3>
                            <h3>".$row['campus']."</h3>
                            <h3>".$row['floor']."</h3>
                            <h3>".$row['extra']."</h3>
                            </br>
                        </div>";
                    }
                } else {
                    echo "There are no results matching your search";
                }
            }
        ?>
    </div>
</body>
</html>