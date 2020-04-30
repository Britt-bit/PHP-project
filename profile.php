<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/classes/User.php");
/* get user */
$user = new User();
$getUser = $user->getUserById($_GET['id']);

/* Error */
$errors = [];
if (!empty($_POST)) {
    /* image info */
    $target_dir = "images/uploads/";
    $target_file = $target_dir . $_FILES['avatar']['name'];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!empty($_POST['avatar'])) {
        if ($_FILES["avatar"]["size"] > 2000000) {
            $errors[] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk != 1) {
            $errors[] = "Upload has failed";
        }
    }
    if (count($errors) == 0) {
        try {
            $user = new User();
            $user->setFirstname($_POST['firstname']);
            $user->setLastname($_POST['lastname']);
            $user->setEmail($_POST['email']);
            $user->setBio($_POST['bio']);
            $user->setAvatar($target_file);
            $user->setYear($_POST['school_year']);
            $user->setBuddy($_POST['buddy']);

            $user->updateUser($_GET['id']);
            header('location: profile.php?id=' . $_GET['id']);
        } catch (\Throwable $th) {
            throw $th;
            $errors[] = "Update failed";
        }
    } else {
        //var_dump($errors);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/profile.css">
    <title>Profiel</title>
</head>

<body>
    <a href="index.php"><img class="logo" src="./images/logo.png" alt="Buddiez logo"></a>

        <form class="profile" action="" method="POST" enctype="multipart/form-data">


                <div class="profile_error">
                <?php if (count($errors) > 0) : ?>
                    <div>
                        <p>
                            <?php foreach ($errors as $error) : ?>
                                <?php echo $error; ?> <br>
                            <?php endforeach ?>
                        </p>
                    </div>
                <?php endif; ?>

                <h1 class="profile_title">Profiel</h1>

                <div class="fields">
                <!-- Avatar field -->
                <div class="avatar">
                    <img class="img-thumbnail" src="<?php echo $getUser['avatar'] ?>" alt="User Avatar">
                    <input type="file" name="avatar" id="avatar" class="inputField">
                </div>
                <!-- Firstname field -->
                <div class="firstname">
                    <label for="firstname">Voornaam:</label>
                    <input type="text" name="firstname" id="firstname"class="inputField" value="<?php echo $getUser['firstname'] ?>">
                </div>
                <!-- Lastname field -->
                <div class="lastname">
                    <label for="lastname">Achternaam:</label>
                    <input type="text" name="lastname" id="lastname" class="inputField"value="<?php echo $getUser['lastname'] ?>">
                </div>
                <!-- email field -->
                <div class="email">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="inputField"value="<?php echo $getUser['email'] ?>">
                </div>
                <!-- password field -->
                <div class="password">
                    <label for="password">Password:</label>
                    <a class="changePassword" href="updatePassword.php?id=<?php echo $_GET['id'] ?>">Change password</a>
                </div>
                <!-- Biography field -->
                <div class="bio">
                    <label for="bio">Biography:</label>
                    <textarea name="bio" id="bio" cols="30" rows="5" class="inputField"><?php echo $getUser['bio'] ?></textarea>
                </div>
                <!-- Year field -->
                <div id="watchOut" class="warning">
                    <p>Kijk uit! Je zit in je eerste jaar. Best een buddy zoeken.</p>
                </div>
                <div class="schoolyear">
                    <label for="year">Schooljaar</label>
                    <select class="inputField" name="school_year" id="year">
                        <option value="">Kies uw jaar ...</option>
                        <option value="1">1IMD</option>
                        <option value="2">2IMD</option>
                        <option value="3">3IMD</option>
                    </select>
                </div>
                <!-- Year field -->
                <div class="buddy">
                    <label for="buddy">Buddy</label>
                    <select class="inputField" name="buddy" id="buddy">
                        <option value="">Ik zoek/ben een buddy ...</option>
                        <option value="0">Ik zoek een buddy</option>
                        <option value="1">Ik ben een buddy</option>
                    </select>
                </div>
                <!-- submit button -->
                <div class="loginSettings">
                    <input type="submit" class="btnSubmit" style="margin-left:300px" value="Update">
                </div>
            </div>
            </div>
        </form>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/updateBuddy.js"></script>
</body>

</html>