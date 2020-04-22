<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/classes/User.php");
/* Als post niet leeg is, spreek setters aan */
if (!empty($_POST)) {
    try {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setBio("Hey, welkom op mijn profiel.");
        $user->setAvatar('images/default.png');
        $user->setYear($_POST['year']);
        $user->setBuddy($_POST['buddy']);

        $email = $_POST['email'];
        $passwordConfirmation = $_POST['passwordConfirmation'];
        function endFunc($str, $lastString)
        {
            $count = strlen($lastString);
            if ($count == 0) {
                return true;
            }
            return (substr($str, -$count) === $lastString);
        }

        if (!empty($_POST['firstname']) || !empty($_POST['lastname'])  || !empty($email) || !empty($_POST['password'])) {
            if (endFunc($email, "@student.thomasmore.be")) {
                if ($user->emailValidation() < 1) {
                    if ($_POST['password'] === $passwordConfirmation) {
                        //email eindigd op @student.thomasmore.be
                        //passwords match
                        //password hashen met functie
                        $user->setPassword($user->passwordHash($password));
                        $user->saveUser();
                        $succes = "User saved";

            if(!empty($_POST['firstname']) || !empty($_POST['lastname'])  || !empty($email) || !empty($_POST['password']) || !empty($_POST['year'])){
                if(endFunc($email, "@student.thomasmore.be")){
                    if($user->emailValidation() < 1){
                        if($_POST['password'] === $passwordConfirmation) {
                            //email eindigd op @student.thomasmore.be
                            //passwords match
			                //password hashen met functie
                            $user->setPassword($user->passwordHash($password));
                            $user->saveUser();
                            $succes = "User saved";
                
                            header("Location: login.php");
                        } else {
                            throw new Exception("Passwords matchen niet");
                        }
                    } else {
                        throw new Exception("Passwords matchen niet");
                    }
                } else {
                    throw new Exception("Email bestaat al");
                }
            } else {
                throw new Exception("Email moet eindigen op @student.thomasmore.be");
            }
        } else {
            $error = $th->getMessage();
        }
    } catch (\Throwable $th) {
        $error = $th->getMessage();
    }
}
$users = User::getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Sign up voor de IMD buddy app.</p>
            </div>

            <form action="" method="POST">
                <div class="form-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="firstname" id="firstname" type="text" class="form-control" placeholder="Jouw naam *" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" />
                            </div>
                            <div class="form-group">
                                <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Jouw achternaam *" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" />
                            </div>

                            <div class="form-group">
                                <label for="year">Jaar</label>
                                <select name="year" id="year">
                                    <option value="1IMD">1IMD</option>
                                    <option value="2IMD">2IMD</option>
                                    <option value="3IMD">3IMD</option>
                                    <option value="mix">Een mix</option>
                                </select>
                            </div>

                            <div class="form-group row col-md-4">
                                <label for="buddy">Buddy</label>
                                <select  name="buddy" id="buddy">
                                    <option value="">Ik zoek/ben een buddy ...</option>
                                    <option value="0">Ik zoek een buddy</option>
                                    <option value="1">Ik ben een buddy</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="email" id="email" type="text" class="form-control" placeholder="Jouw email *" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
                            </div>
                            <div class="form-group">
                                <input name="password" id="password" type="password" class="form-control" placeholder="Jouw Password *" value="" />
                            </div>
                            <div class="form-group">
                                <input name="passwordConfirmation" id="passwordConfirmation" type="password" class="form-control" placeholder="Bevestig je password *" value="" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnSubmit">Registreer</button>
                    <br> <br>
                    <div id="errorMessage">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <p>
                                    <?php echo $error; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/usernameCheck.js"></script>
</body>

</html>