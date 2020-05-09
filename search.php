<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once(__DIR__ ."/classes/Post.php");
include_once(__DIR__ ."/classes/Db.php");
include_once(__DIR__ ."/includes/nav.inc.php");



$search = Post::search(strtolower($_GET['search']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Zoek</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<<<<<<< Updated upstream
<?php include_once 'includes/nav.inc.php'; ?>
=======
   <!--navigatie-->        
   <nav>

    <a style="color: rgb(245, 134, 124);"href="index.php?id=<?php $_SESSION['user_id'] ?>">Home</a>
    <a href="profile.php?id=<?php $_SESSION['user_id'] ?>">Profile</a>
    <a href="buddies.php?id=<?php $_SESSION['user_id'] ?>">My buddies</a>
    <a href="match.php?id=<?php $_SESSION['email'] ?>">My matches</a>
    <a href="logout.php" class="logout">Logout</a>
    </nav>
>>>>>>> Stashed changes


<h3><?php echo htmlspecialchars($_GET['search']); ?></h3>

 <!-- zoekresultaat tonen -->

<?php $conn = Db::getConnection(); ?>


<?php if ($search > 0): foreach ($search as $searchResult):?>
<<<<<<< Updated upstream

    <div class="profile">
        <img class="avatar" src="<?php echo $searchResult['avatar']?>" alt="">
        <h1><?php echo htmlspecialchars($searchResult['firstname']) . " " . htmlspecialchars($searchResult['lastname']); ?></h1>
=======
    <?php var_dump($searchResult); ?>
    <div class="searchResult">
        <img class="profilePic" src="<?php echo $searchResult['avatar']?>" alt="">
        <h2><?php echo htmlspecialchars($searchResult['firstname']) . " " . htmlspecialchars($searchResult['lastname']); ?></h2>
>>>>>>> Stashed changes
        <p>Games: <?php echo $searchResult['games']; ?></p>
        <p>Films:<?php echo $searchResult['films']; ?></p>
        <p>Muziek:<?php echo $searchResult['muziek']; ?></p>
        <p>Vak:<?php echo $searchResult['vak']; ?></p>
        <p>hobby:<?php echo htmlspecialchars($searchResult['hobby']); ?></p>
        <p><button class="">Profiel</button></p> 
    </div>     
 
<?php endforeach; ?> 
<?php endif; ?>

</body>
</html>