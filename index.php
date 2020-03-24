<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP project</title>
</head>
<body>
    <h1>Logged in</h1>
    <a class="nav-link" href="profile.php?id=<?php $_SESSION['user'][0] ?>">Profile</a>
</body>
</html>