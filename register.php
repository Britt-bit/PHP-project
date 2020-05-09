<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include_once(__DIR__ . "/classes/User.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


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

        if (!empty($_POST['firstname']) || !empty($_POST['lastname'])  || !empty($email) || !empty($_POST['password']) || !empty($_POST['year']) || !empty($_POST['buddy'])) {
            if (endFunc($email, "@student.thomasmore.be")) {
                var_dump($user->emailValidation());
                if ($user->emailValidation() != 0) {
                    if ($_POST['password'] === $passwordConfirmation) {

                        //email eindigd op @student.thomasmore.be
                        //passwords match
                        //password hashen met functie
                        
                        $user->setPassword($user->passwordHash($_POST['password']));
                        
                        //var_dump($user);
                        
                            
                        if($user->saveUser()){
                            $succes = "User saved";
                            $mail = new PHPMailer(true);

                            try {
                            //Server settings
                                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                                $mail->isSMTP();                                            // Send using SMTP
                                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                                $mail->Username   = 'Buddiez.PHP@gmail.com';                     // SMTP username
                                $mail->Password   = '4@1dgbo(w@93G8B';                               // SMTP password
                                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                                //$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                                $mail->Port       = 465; 
                                $mail->SMTPSecure = "ssl"; 

                                //Recipients
                                $mail->setFrom('Buddiez.PHP@gmail.com', 'Buddiez team');
                                $mail->addAddress($email);     // Add a recipient

                                // Content
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Email verification';
                                $mail->Body    = '<a href="http://localhost/PHP-project/verify.php?vkey=' . $vkey . '"> Register Account</a>';
                                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                                $mail->send();
                                echo 'Message has been sent';
                                header("Location: login.php");
                                
                            } catch (Exception $e) {
                                echo "Something went wrong, please try again";
                                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            }
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
            throw new Exception("Vul aub alles in");
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
            <h1 style="font-size:30px; margin-top:-50px;">Sign up for the IMD buddy app.</h1>
            </div>

            <form action="" method="POST">
                <div>
                    <div>
                        <div>
                            <div>
                                <input name="firstname" id="firstname" type="text" class="inputField" placeholder="Your name *" value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>" />
                            </div>
                            <div>
                                <input name="lastname" id="lastname" type="text" class="inputField" placeholder="Your lastname *" value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>" />
                            </div>

                            <div>
                                <select class="inputField"name="year" id="year">
                                    <option value="1IMD">1IMD</option>
                                    <option value="2IMD">2IMD</option>
                                    <option value="3IMD">3IMD</option>
                                    <option value="mix">A mix</option>
                                </select>
                            </div>


                            <div>
                                <select  class="inputField" name="buddy" id="buddy">
                                    <option value="0">I'm looking for a buddy</option>
                                    <option value="1">I'm a buddy</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div id="errorMessage">
                                
                            </div>
                            <div>
                                <input name="email" id="email" type="text" class="inputField" placeholder="Your email *" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
                            </div>
                            <div>
                                <input name="password" id="password" type="password" class="inputField" placeholder="Your password *" value="" />
                            </div>
                            <div>
                                <input name="passwordConfirmation" id="passwordConfirmation" type="password" class="inputField" placeholder="Cofirm password *" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="loginSettings">
                    <button type="submit" name="submit" class="btnSubmit">Register</button>
                    <br> <br>
                    <p>Already an account? <a href="login.php">Login</a></p>
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
