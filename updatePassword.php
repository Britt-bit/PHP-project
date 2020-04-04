<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

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
                    $errors[] = 'Old password was incorrect';
                }

            } catch (\Throwable $th) {
               $errors[] = 'Password not updated';
            }
        }
        

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="container">
    <?php if (count($errors) > 0): ?>
			<div class="alert alert-danger mt-5">
				<p>
					<?php foreach ($errors as $error):?>
                     <?php echo $error; ?> <br>
                   <?php endforeach?>
							
				</p>
			</div>
        <?php endif; ?>
        <div class="note">
            <p>Password</p>
                
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-content">
                <!-- Old password field -->
                <div class="form-group row col-md-4 text-center">
                        <label for="password">Old password:</label>
                        <input type="password" name="password" id="password">
                    </div>
                <div class="passcheck">
                    
                </div>
                 <!-- New password field -->
                    <div class="form-group row col-md-7 text-center">
                        <label for="newPassword">New password:</label>
                        <input type="password" name="newPassword" id="newPassword">
                    </div>
                <!-- Confirm password field -->
                    <div class="form-group row col-md-7 text-center">
                        <label for="confirmPassword">Confirm password:</label>
                        <input type="password" name="confirmPassword" id="confirmPassword">
                    </div>
                <!-- submit button -->
                    <div class="form-group row col-md-7 text-center">
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a class="btn btn-primary ml-2" href="profile.php?id=<?php echo $_GET['id'] ?>">Cancel</a>
                    </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="js/passwordCheck.js"></script>
</body>
</html>
