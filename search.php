<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ ."/classes/Post.php");
include_once(__DIR__ ."/classes/Db.php");
include_once(__DIR__ ."/includes/nav.inc.php");

if ($_SESSION['email']  == '') {
    header ("Location: login.php");
}


$search = Post::search(strtolower($_GET['search']));

?>

<!DOCTYPE html>
<html lang="en">
<head>

<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/search.css">

    <title>Search</title>
</head>
<body>
<a href="index.php"><img class="logo" src="./images/logo.png" alt="Buddiez logo"></a>

   <!--navigatie-->        
   <nav>

    <a style="color: rgb(245, 134, 124);"href="index.php?id=<?php echo $_SESSION['user_id'] ?>">Home</a>
    <a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>">Profile</a>
    <a href="buddies.php?id=<?php $_SESSION['user_id'] ?>">My buddies</a>
    <a href="match.php?id=<?php $_SESSION['email'] ?>">My matches</a>
    <a href="logout.php" class="logout">Logout</a>
    </nav>


<div class="box">
<h6>You were looking for...</h6>
 <!--Zoekfunctie-->  
 <div>
<?php include_once 'includes/nav.inc.php'; ?>
<h5><?php echo htmlspecialchars($_GET['search']); ?></h5>
</div>  

<!-- zoekresultaat tonen -->

<?php $conn = Db::getConnection(); ?>



<?php if ($search > 0): foreach ($search as $searchResult):?>

    <div class="searchResult">
        <img class="profilePic" src="<?php echo $searchResult['avatar']?>" alt="">
        <h2><?php echo htmlspecialchars($searchResult['firstname']) . " " . htmlspecialchars($searchResult['lastname']); ?></h2>
        <p>Games: <?php echo $searchResult['games']; ?></p>
        <p>Movies:<?php echo $searchResult['films']; ?></p>
        <p>Music:<?php echo $searchResult['muziek']; ?></p>
        <p>Course:<?php echo $searchResult['vak']; ?></p>
        <p>hobby:<?php echo htmlspecialchars($searchResult['hobby']); ?></p>
        
       
       <?php echo "<a class='lookProfile' href='profile.php?id=".$searchResult["user_id"]."'>Profiel</a>" ?>
       

        
       
    </div>     
 
<?php endforeach; ?> 
<?php endif; ?>   
</div>
 

</body>
</html>