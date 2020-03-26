<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

    include_once(__DIR__ ."/classes/User.php");
    /* get user */
    $user = new User();
    $getUser = $user->getUserById($_GET['id']);
    /* password update */

    if (!empty($_POST)) {
        if ($_FILES["fileToUpload"]["size"] > 2000000) {
            return $error = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return $error = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk != 1) {
            return $error = "Something went wrong";
        }
        $user = new User();
        

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
        <?php if (isset($error)): ?>
			<div class="form__error">
				<p>
					<?php echo $error ?>
							
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
                 <!-- New password field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="newPassword">New password:</label>
                        <input type="password" name="newPassword" id="newPassword">
                    </div>
                <!-- Confirm password field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="confirmPassword">Confirm password:</label>
                        <input type="password" name="confirmPassword" id="confirmPassword">
                    </div>
                <!-- submit button -->
                    <div class="form-group row col-md-4 text-center">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>