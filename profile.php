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
$getRequest = $request->getRequest($_SESSION['user_id']);

$buddy = new Request();
$getbuddy = $buddy->getbuddy($_GET['id']);

$seeker = new Request();
$getseeker = $seeker->getseeker($_SESSION['user_id']);

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
    <title>Profiel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>

    <div class="container">
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-danger mt-5">
                <p>
                    <?php foreach ($errors as $error) : ?>
                        <?php echo $error; ?> <br>
                    <?php endforeach ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="note">
            <p>Profiel</p>
        </div>
        <?php if ($getUser['user_id'] == $_SESSION['user_id']) : ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-content">
                    <!-- show if Buddy -->
                    <?php if ($getRequest['request'] == null && $getRequest['accepted'] == null) : ?>
                        <div class="alert alert-info">
                            <p>You are a buddy you cannot send a request.</p>
                        </div>
                    <?php elseif ($getRequest['buddy_id'] == $_SESSION['user_id'] && $getRequest['request'] == 1) : ?>
                        <div class="alert alert-info col-md-8 d-block">
                            <p>You have a buddy request from <?php echo $getseeker['firstname'] ?>.</p>
                        </div>
                        <div class="d-block">
                            <a href="#" id="AcceptRequest" class="btn btn-success btn-lg" role="button">Accept</a>
                            <a href="#" id="DeleteRequest" class="btn btn-danger btn-lg ml-3" role="button">Decline</a>
                        </div>
                        <div class="hidden">
                            <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['user_id'] ?>">
                            <input type="hidden" name="uid" id="uid" value="<?php echo $getseeker['user_id'] ?>">
                        </div>
                        <script type="text/javascript" src="js/AcceptBuddyRequest.js"></script>
                        <script type="text/javascript" src="js/DeleteBuddyRequest.js"></script>
                    <?php elseif ($getRequest['buddy_id'] == $_SESSION['user_id'] || $getRequest['seeker_id'] == $_SESSION['user_id'] && $getRequest['request'] == 0 && $getRequest['accepted'] == 1) : ?>
                        <div class="alert alert-info col-md-8 d-block">
                            <p>You are buddies with <?php if ($getseeker != false) {
                                                        echo $getseeker['firstname'];
                                                    } else {
                                                        echo $getbuddy['firstname'];
                                                    }  ?>.</p>
                        </div>
                    <?php endif ?>
                    <!-- Avatar field -->
                    <div class="form-group row col-md-4 mt-3">
                        <img class="img-thumbnail" src="<?php echo $getUser['avatar'] ?>" alt="User Avatar">
                        <input type="file" name="avatar" id="avatar" class="form-control">
                    </div>
                    <!-- Firstname field -->
                    <div class="form-group row col-md-4">
                        <label for="firstname">Voornaam:</label>
                        <input type="text" name="firstname" id="firstname" value="<?php echo $getUser['firstname'] ?>">
                    </div>
                    <!-- Lastname field -->
                    <div class="form-group row col-md-4">
                        <label for="lastname">Achternaam:</label>
                        <input type="text" name="lastname" id="lastname" value="<?php echo $getUser['lastname'] ?>">
                    </div>
                    <!-- email field -->
                    <div class="form-group row col-md-4">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" value="<?php echo $getUser['email'] ?>">
                    </div>
                    <!-- password field -->
                    <div class="form-group row col-md-4">
                        <label for="password">Password:</label>
                        <a class="nav-link" href="updatePassword.php?id=<?php echo $_GET['id'] ?>">Change password</a>
                    </div>
                    <!-- Biography field -->
                    <div class="form-group row col-md-4">
                        <label for="bio">Biography:</label>
                        <textarea name="bio" id="bio" cols="30" rows="5"><?php echo $getUser['bio'] ?></textarea>
                    </div>
                    <!-- Year field -->
                    <div id="watchOut" class="alert alert-warning">
                        <p>Kijk uit! Je zit in je eerste jaar. Best een buddy zoeken.</p>
                    </div>
                    <div class="form-group row col-md-4">
                        <label for="year">Schooljaar</label>
                        <select class="form-control" name="school_year" id="year">
                            <option value="">Kies uw jaar ...</option>
                            <option value="1">1IMD</option>
                            <option value="2">2IMD</option>
                            <option value="3">3IMD</option>
                        </select>
                    </div>
                    <!-- Year field -->
                    <div class="form-group row col-md-4">
                        <label for="buddy">Buddy</label>
                        <select class="form-control" name="buddy" id="buddy">
                            <option value="">Ik zoek/ben een buddy ...</option>
                            <option value="0">Ik zoek een buddy</option>
                            <option value="1">Ik ben een buddy</option>
                        </select>
                    </div>
                    <!-- submit button -->
                    <div class="form-group row col-md-4 text-center">
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
            <div class="hidden">
                <input id="id" type="hidden" name="id" value="<?php echo $_SESSION['user_id'] ?>">
                <input id="uid" type="hidden" name="uid" value="<?php echo $getseeker['user_id']; ?>">
                <input id="uri" type="hidden" value="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            </div>
            <script src="js/updateBuddy.js"></script>


        <?php elseif ($getUser['user_id'] != $_SESSION['user_id']) : ?>
            <?php var_dump($getRequest) ?>
            <?php if ($getRequest['buddy_id'] == $_SESSION['user_id'] || $getRequest['seeker_id'] == $_SESSION['user_id'] && $getRequest['request'] == 0 && $getRequest['accepted'] == 1) : ?>
                <div class="alert alert-info col-md-8 d-block mt-3">
                    <p>This is your buddy</p>
                </div>
                <a href="#" id="DeleteRequest" class="btn btn-danger btn-lg mb-3" role="button">Delete Buddy</a>
                    <script type="text/javascript" src="js/DeleteBuddyRequest.js"></script>
            <?php endif ?>
            <div class="form-group row col-md-12">
                <img class="img-thumbnail" src="<?php echo $getUser['avatar'] ?>" alt="User Avatar">
            </div>
            <div class="form-group row col-md-12">
                <label for="fullname">Naam: </label>
                <p id="fullname" class="ml-1" value='<?php echo $getUser['firstname'];
                    echo ' ';
                    echo $getUser['lastname'] ?>'><?php echo $getUser['firstname'];
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
                <input id="email" type="hidden" value="<?php echo $getUser['email']; ?>">
                <input id="uri" type="hidden" value="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            </div>

            <?php if ($getUser['buddy'] == 1) : ?>
                <div id="requestBtn" class="form-group row col-md-12">
                    <?php if ($getRequest['request'] == null && $getRequest['accepted'] == null) : ?>
                        <a href="#" id="sendRequest" class="btn btn-primary btn-lg" role="button">Buddy Request</a>
                        <script type="text/javascript" src="js/sendBuddyRequest.js"></script>
                    <?php elseif ($getRequest['request'] == 1 && $getRequest['buddy_id'] == $_GET['id']) : ?>
                        <a href="#" class="btn btn-secondary btn-lg disabled" role="button">Requested</a>
                    <?php elseif (class_exists('btn-danger')) : ?>
                        <a href="#" class="btn btn-danger btn-lg disabled" role="button">Declined</a>
                    <?php elseif (!class_exists('btn-danger')) : ?>
                    <?php endif ?>
                <?php endif ?>
                </div>
            <?php endif ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>