<?php
//user email: britt@student.thomasmore.be --- --- --- password: Password123
//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
 
//connectie met de database
function canLogin($email, $password){
    $conn = new mysqli("localhost", "root", "root", "phpProject");
    $email = $conn->real_escape_string($email);
    $query = "SELECT `user_id`,`email`, `password` FROM `user` WHERE email = '$email'";
    $result = $conn->query($query);
    $user = $result->fetch_assoc();

    if(password_verify($password, $user['password'])){
        return true;
    }else{
        return false;
    }
}
 
//Get de User
//Error
$errors = [];
 
//Detecteer submit
if(!empty($_POST)){
    try{
    $user = new User();
 
    //Velden uitlezen in variabelen
    $email = $_POST['email'];
    $password = $_POST['password'];
   
    //Validatie: velden mogen niet leeg zijn
    if(!empty($email) && !empty($password)){
     if(User::isUserVerified($email)){
        if(canLogin($email, $password,$user_id)){
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $user_id;


            //if ($verified == 1){
               header ("Location: index.php");
            //} else {
            //    $error="Dit account is nog niet geverifieerd";
            //}
            
        }else{
            //User en password matchen niet
            //Error
            $error="Cannot log you in.";
        }}
        else {
            $error="Email not yet verified";
        }
    }else{
        //Indien leeg: error genereren
        $error = "Email and password are required.";
    }
} catch(\Throwable $th) {
    $error = $th->getMessage();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/login.css">
    <title>Login</title>
</head>
<body>
 
        <form action="" method="POST">
            <div class="form">  

            <!--Logo-->
            <img class="logo" src="./images/logo.png" alt="Buddiez logo">

            <!--Error melding-->
            <?php if( isset($error) ): ?>
            <div class="error" role="alert">
                <p> <?php echo $error; ?> </p>
            </div>
            <?php endif;?>
            <h1>Login</h1>


                <!-- Email veld -->
                <div class="email">
                    <input name="email" id="email" type="text" placeholder="Email" class= "inputField" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
           
                <!-- Password veld -->
                <div class="password">
                    <input name="password" id="password" type="password" placeholder="Password" class= "inputField"  value="">
                </div>    
 
                <!--Login button-->
                <div class="loginSettings">
                    <button type="submit" class="btnSubmit" style="border-radius: 20px; width: 150px;" >LOGIN</button>
                        <br><br>
                        <!--onthoud mij checkbox-->  
                    <input type="checkbox" class="checkbox" id="rememberMe"><label for="rememberMe" class="rememberMe">Remember me</label>
                        <br>

                    <!--Nog geen account?-->
                    <p>Don't have an account yet? <a href="register.php">Register</a></p>    

            </div>        
        </form>
        </div>
    </div>
</div>
   
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
