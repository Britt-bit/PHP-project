<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL); */

    include_once(__DIR__ ."/classes/User.php");
    /* get user */
    $user = new User();
    $getUser = $user->getUserById($_GET['id']);

    /* Error */
    $errors = [];
    /* password update */

    if (!empty($_POST)) {
        if ($_POST["newPassword"] == $_POST["confirmPassword"]) {
            try {
                if (password_verify($_POST['password'], $getUser['password'])) {
                    $user->setNewPassword($user->passwordHash($_POST['newPassword']));
                    $user->updatePassword($_GET['id']);
                    header('location: profile.php?id='.$_GET['id'] );
                }
                else {
                    $errors[] = 'Old password was false';
                }
            } catch (\Throwable $th) {
               $errors[] = 'Password not geupdated';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/updatePassword.css">

    <title>Update Password</title>
</head>
<body>

<!--Logo-->
<a href="index.php"><img class="logo" src="./images/logo.png" alt="Buddiez logo"></a>


        <form class="passForm" action="" method="POST" enctype="multipart/form-data">

        <h1 class="profile_title">Password</h1>
        <h4 style="margin-left:50px; font-size:15px">Do you want to set a new password?</h4>
        <!--Error-->
        
            <?php if (count($errors) > 0): ?>
                <div class="passError">
                    <p>
                        <?php foreach ($errors as $error):?>
                        <?php echo $error; ?> <br>
                        <?php endforeach?>		
                    </p>
                </div>
            <?php endif; ?>
                <div class="note">
                    
    
                <!-- Old password field -->
                <div class="oldPassword">
                        <label class="labelFields" for="password">Old password:</label>
                        <input type="password" class="inputField" name="password" id="password">
                    </div>
                <div class="passcheck">
                    
                </div>
                 <!-- New password field -->
                    <div class="newPassword">
                        <label class="labelFields" for="newPassword">New password:</label>
                        <input type="password" class="inputField" name="newPassword" id="newPassword">
                    </div>
                <!-- Confirm password field -->
                    <div class="confirmPassword">
                        <label class="labelFields" for="confirmPassword">Confirm password:</label>
                        <input type="password" class="inputField" name="confirmPassword" id="confirmPassword">
                    </div>
                <!-- submit button -->
                    <div class="loginSettings">
                        <input type="submit" class="btnSubmit" value="Update">
                       <p><a href="profile.php?id=<?php echo $_GET['id'] ?>">Cancel</a></p> 
                    </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="js/passwordCheck.js"></script>
</body>
</html>
