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

<?php include_once 'includes/nav.inc.php'; ?>


<h3><?php echo htmlspecialchars($_GET['search']); ?></h3>

 <!-- zoekresultaat tonen -->

<?php $conn = Db::getConnection(); ?>


<?php if ($search > 0): foreach ($search as $searchResult):?>

    <div class="profile">
        <img class="avatar" src="<?php echo $searchResult['avatar']?>" alt="">
        <h1><?php echo htmlspecialchars($searchResult['firstname']) . " " . htmlspecialchars($searchResult['lastname']); ?></h1>
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