<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

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

        $vkey = md5(time().$_POST['lastname']);
        $user->setVkey($vkey);

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

        if (!empty($_POST['firstname']) || !empty($_POST['lastname'])  || !empty($email) || !empty($_POST['password']) || !empty($_POST['year'])) {
            if (endFunc($email, "@student.thomasmore.be")) {
                if ($user->emailValidation() < 1) {
                    if ($_POST['password'] === $passwordConfirmation) {

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
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/register.css">
    <title>Registreer</title>
</head>

<body>

    <div>
        <div class="register">
            <div>
            <!--Logo-->
            <img class="logo" src="./images/logo.png" alt="Buddiez logo">
            <h1 style="font-size:30px; margin-top:-50px;">Sign up voor de IMD buddy app.</h1>
            </div>

            <form action="" method="POST">
                <div>
                    <div>
                        <div>
                            <div>
                                <input name="firstname" id="firstname" type="text" class="inputField" placeholder="Jouw naam *" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" />
                            </div>
                            <div>
                                <input name="lastname" id="lastname" type="text" class="inputField" placeholder="Jouw achternaam *" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" />
                            </div>

                            <div>
                                <select class="inputField"name="year" id="year">
                                    <option value="1IMD">1IMD</option>
                                    <option value="2IMD">2IMD</option>
                                    <option value="3IMD">3IMD</option>
                                    <option value="mix">Een mix</option>
                                </select>
                            </div>

                            <div>
                                <select class="inputField" name="buddy" id="buddy">
                                    <option value="">Ik zoek/ben een buddy ...</option>
                                    <option value="0">Ik zoek een buddy</option>
                                    <option value="1">Ik ben een buddy</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div>
                                <input name="email" id="email" type="text" class="inputField" placeholder="Jouw email *" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
                            </div>
                            <div>
                                <input name="password" id="password" type="password" class="inputField" placeholder="Jouw Password *" value="" />
                            </div>
                            <div>
                                <input name="passwordConfirmation" id="passwordConfirmation" type="password" class="inputField" placeholder="Bevestig je password *" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="loginSettings">
                    <button type="submit" name="submit" class="btnSubmit">Registreer</button>
                    <br> <br>
                    <p>Al een account? <a href="login.php">Login</a></p>
                    </div>
                    <br>
                    <?php if( isset($error) ): ?>
				    <div class="registerError" role="alert">
					    <p>
						    <?php echo $error; ?>
					    </p>
				    </div>
				    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="js/usernameCheck.js"></script>
</body>

</html>