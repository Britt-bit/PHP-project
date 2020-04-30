<?php
 
//user email: britt@student.thomasmore.be --- --- --- password: Password123
 
//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
 
//connectie met de database
function canLogin($email, $password){
 //   $conn = Db::getConnection();
 //   $statement = $conn->prepare("SELECT `email`, `password` FROM `user` WHERE email = '$email'");
 //   $statement->execute();
 //   $user = $statement->fetchAll(PDO::FETCH_ASSOC);
 
 $conn = new mysqli("localhost", "root", "root", "phpProject");
 $email = $conn->real_escape_string($email);
 $query = "SELECT `email`, `password` FROM `user` WHERE email = '$email'";
 $result = $conn->query($query);
 $user = $result->fetch_assoc();
 
 //var_dump($user);

 //Gehashte password, unhashen
 if(password_verify($password, $user['password'])){
    return true;
    }else{
        return false;
    }

    if($password == $user['password']){
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
       
        if(canLogin($email, $password)){
            session_start();
            $_SESSION['email'] = $email;
 
            header ("Location: index.php");

    }else{
            //User en password matchen niet
            //Error
            $error="*Cannot log you in.";
    }
    }else{
        //Indien leeg: error genereren
        $error = "*Email and password are required.";
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
    <link rel="stylesheet" href="./css/style.css">
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
                        <p>
                        <?php echo $error; ?>
                        </p>
                    </div>
                <?php endif;?>

                    <h1> Login</h1>

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
                        <button type="submit" class="btnSubmit">LOGIN</button>
                        <br><br>
                        <!--onthoud mij checkbox-->  
                        <input type="checkbox" class="checkbox" checked="checked"><label class="rememberMe"for="rememberMe" class="">Remember me</label>
                        <br>
                        <!--Password vergeten-->
                        <!--<a href="">Forgot password?</a>
                        <br> -->
                        <!--Nog geen account?-->
                        <p>You don't have an account yet? <a href="register.php">Register.</a></p>    
                    </div>
            </div>        
        </form>
    </div>
</div>
</div>
</div>  

</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</html>
