<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

    include_once(__DIR__ ."/classes/User.php");
    /* get user */
    $user = new User();
    $getUser = $user->getUserById($_GET['id']);
    /* image info */
    $target_dir = "images/uploads/";
    $target_file = $target_dir . $_FILES['avatar']['name'];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!empty($_POST)) {
        if ($_FILES["avatar"]["size"] > 2000000) {
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
        try {
            $user = new User();
            $user->setFirstname($_POST['firstname']);
		    $user->setLastname($_POST['lastname']);        
		    $user->setEmail($_POST['email']);
            $user->setBio($_POST['bio']);
            $user->setAvatar($target_file);

            $user->updateUser();
            return $succes = "Update completed";
        } catch (\Throwable $th) {
            throw $th;
            return $error = "Update failed";
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
    <?php if (isset($succes)): ?>
			<div class="alert alert-success">
				<p>
					<?php echo $succes ?>
							
				</p>
			</div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
			<div class="alert alert-danger">
				<p>
					<?php echo $error ?>
							
				</p>
			</div>
        <?php endif; ?>
        <div class="note">
            <p>Profile</p>
                
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-content">
                <!-- Avatar field -->
                    <div class="form-group row col-md-4 text-center">
                        <img src="<?php echo $getUser['avatar'] ?>" alt="User Avatar">
                        <input type="file" name="avatar" id="avatar" class="form-control">
                    </div>
                <!-- Firstname field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="firstname">Firstname:</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $getUser['firstname'] ?>">
                    </div>
                <!-- Lastname field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="lastname">Lastname:</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $getUser['lastname'] ?>">
                    </div>
                <!-- email field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email"value="<?php echo $getUser['email'] ?>">
                    </div>
                 <!-- password field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="password">Password:</label>
                         <a class="nav-link" href="updatePassword.php?id=<?php echo $_GET['id'] ?>">Change password</a>
                    </div>
                <!-- Biography field -->
                    <div class="form-group row col-md-4 text-center">
                        <label for="bio">Biography:</label>
                        <textarea name="bio" id="bio" cols="30" rows="5"><?php echo $getUser['bio'] ?></textarea>
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