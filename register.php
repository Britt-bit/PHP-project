<?php
include_once(__DIR__ ."/classes/User.php");
    if(!empty($_POST)){
        try {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setBio("Hey, welkom op mijn profiel.");
        $user->setAvatar("href='images/default.png'");

        $email = $_POST['email'];
        $passwordConfirmation = $_POST['passwordConfirmation'];

            function endFunc($str, $lastString) {
                $count = strlen($lastString);
                if($count == 0){
                    return true;
                }
                return (substr($str, -$count) === $lastString);
            } 

            if(!empty($_POST['firstname']) || !empty($_POST['lastname'])  || !empty($email) || !empty($_POST['password'])){
                if(endFunc($email, "@student.thomasmore.be")){
                    if($user->emailValidation() < 1){
                        if($_POST['password'] === $passwordConfirmation) {
                            //email eindigd op @student.thomasmore.be
                            //passwords match
                            $user->setPassword($user->passwordHash($password));
                            $user->saveUser();
                            $succes = "User saved";
                
                            header("Location: index.php");
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
            
    } catch (\Throwable $th){
        $error = $th->getMessage();
    }
    } 

    $users = User::getAllUsers();



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/register.css">
    <title>Register</title>
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
                                <input name="firstname" id="firstname" type="text" class="inputField" placeholder="Your Name *" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname']; ?>"/>
                            </div>
                            <div>
                                <input name="lastname" id="lastname" type="text" class="inputField" placeholder="Your lastname *" value="<?php if(isset($_POST['lastname'])) echo $_POST['lastname']; ?>"/>
                            </div>
                        </div>
                        <div>
                            <div>
                                <input name="email" id="email" type="text" class="inputField" placeholder="Your email *" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
                            </div>
                            <div>
                                <input name="password" id="password" type="password" class="inputField" placeholder="Your Password *" value=""/>
                            </div>
                            <div>
                                <input name="passwordConfirmation" id="passwordConfirmation" type="password" class="inputField" placeholder="Confirm your password *" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class=loginSettings>
                    <button type="submit" class="btnSubmit">Sign me up</button>
                    <p>You already have an account? <a href="login.php">Login.</a></p>    

                    </div>
                    <br> <br>

                <!--Error-->
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

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>