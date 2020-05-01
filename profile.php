<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Features.class.php");
include_once(__DIR__ . "/classes/Request.php");
/* get user */
$user = new User();
$getUser = $user->getUserById($_GET['id']);

$features = new Feature();
$getFeatures = $features->getFeaturesFromUser($_GET['id']);

$request = new Request();
$getRequest = $request->getRequest($_GET['id'], $_SESSION['user_id']);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>
    <a href="index.php"><img class="logo" src="./images/logo.png" alt="Buddiez logo"></a>

        <form class="profile" action="" method="POST" enctype="multipart/form-data">



        <h1 class="profile_title">Profiel</h1>

        <?php if ($getUser['user_id'] == $_SESSION['user_id']) : ?>
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="fields">
                    <!-- Avatar field -->
                    <div class="avatar">
                        <img class="img-thumbnail" src="<?php echo $getUser['avatar'] ?>" alt="User Avatar">
                        <input type="file" name="avatar" id="avatar" class="inputField">
                    </div>
                    <!-- Firstname field -->
                    <div class="firstname">
                        <label for="firstname">Firstname:</label>
                        <input type="text" name="firstname"  class="inputField" id="firstname" value="<?php echo $getUser['firstname'] ?>">
                    </div>
                    <!-- Lastname field -->
                    <div class="lastname">
                        <label for="lastname">Lastname:</label>
                        <input type="text" name="lastname"  class="inputField" id="lastname" value="<?php echo $getUser['lastname'] ?>">
                    </div>
                    <!-- email field -->
                    <div class="email">
                        <label for="email">Email:</label>
                        <input type="text" name="email"  class="inputField" id="email" value="<?php echo $getUser['email'] ?>">
                    </div>
                    <!-- password field -->
                    <div class="password">
                        <label for="password">Password:</label>
                        <a class="nav-link"  class="inputField" href="updatePassword.php?id=<?php echo $_GET['id'] ?>">Change password</a>
                    </div>
                    <!-- Biography field -->
                    <div class="bio">
                        <label for="bio">Biography:</label>
                        <textarea name="bio" id="bio"  class="inputField" cols="30" rows="5"><?php echo $getUser['bio'] ?></textarea>
                    </div>
                    <!-- Year field -->
                    <div id="watchOut" class="warning">
                        <p>Watch out! You're in your first year. Look for a buddy.</p>
                    </div>
                    <div class="schoolyear">
                        <label for="year">Schoolyear</label>
                        <select class="inputField" name="school_year" id="year">
                            <option value="">Choose year ...</option>
                            <option value="1">1IMD</option>
                            <option value="2">2IMD</option>
                            <option value="3">3IMD</option>
                        </select>
                    </div>
                    <!-- Year field -->
                    <div class="buddy">
                        <label for="buddy">Buddy</label>
                        <select class="inputField" name="buddy" id="buddy">
                            <option value="">I'm looking for/ I'm a buddy ...</option>
                            <option value="0">I'm looking for a buddy</option>
                            <option value="1">I'm a buddy</option>
                        </select>
                    </div>
                    <!-- submit button -->
                    <div class="loginSettings">
                        <input type="submit" class="btnSubmit" style="margin-left:300px" value="Update">
                    </div>
                </div>
            </form>
            <script src="js/updateBuddy.js"></script>
        <?php elseif ($getUser['user_id'] != $_SESSION['user_id']) : ?>
            <div class="form-group row col-md-12">
                <img class="img-thumbnail" src="<?php echo $getUser['avatar'] ?>" alt="User Avatar">
            </div>
            <div class="form-group row col-md-12">
                <label for="firstname">Naam: </label>
                <p class="ml-1"><?php echo $getUser['firstname'];
                                echo ' ';
                                echo $getUser['lastname'] ?>
                </p>
            </div>
            <div class="form-group row col-md-12">
                <label for="firstname">Biography: </label>
                <p class="ml-1"><?php echo $getUser['bio']; ?></p>
            </div>
            <div class="form-group row col-md-12">
                <label for="">Features: </label>
                <?php
                for ($i = 0; $i < count($getFeatures) / 2; $i++) {
                    echo "<span class='ml-1'>" . $getFeatures[$i] . ",</span>";
                }
                echo "...";
                ?>
            </div>
            <div class="hidden">
                <input id="id" type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                <input id="uid" type="hidden" name="uid" value="<?php echo $_SESSION['user_id']; ?>">
            </div>
            <div id="watchOut" class="alert alert-success">
                <p>Watch out! You're in your first year. Look for a buddy.</p>
            </div>
            <?php if ($getRequest['request'] == null && $getRequest['accepted'] == null) : ?>
                <div class="form-group row col-md-12">
                    <a href="#" id="sendRequest" class="btn btn-primary btn-lg" role="button">Buddy Request</a>
                </div>
            <?php elseif ($getRequest['request'] == 1 && $getRequest['buddy_id'] == $_GET['id']) : ?>
                <div class="form-group row col-md-12">
                    <a href="#" class="btn btn-secondary btn-lg disabled" role="button">Requested</a>
                </div>
            <?php elseif ($getRequest['seeker_id'] == $_GET['id'] && $getRequest['request'] == 1) : ?>
                <div class="form-group row col-md-12">
                    <a href="#" id="AcceptRequest" class="btn btn-success btn-lg" role="button">Accept</a>
                    <a href="#" id="DeleteRequest" class="btn btn-danger btn-lg ml-3" role="button">Decline</a>
                </div>
                <script type="text/javascript" src="js/AcceptBuddyRequest.js"></script>
                <script type="text/javascript" src="js/DeleteBuddyRequest.js"></script>
            <?php elseif ($getRequest['accepted'] == 1) : ?>
                <div class="form-group row col-md-12">
                    <a href="#" id="deleteBuddy" class="btn btn-danger btn-lg" role="button">Delete Buddy</a>
                </div>
            <?php elseif ($getRequest['accepted'] == 0 && $getRequest['accepted'] != null) : ?>
                <div class="form-group row col-md-12">
                    <a href="#" class="btn btn-danger btn-lg disabled" role="button">Declined</a>
                </div>
            <?php endif ?>
            <script type="text/javascript" src="js/sendBuddyRequest.js"></script>
        <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/updateBuddy.js"></script>
</body>

</html>