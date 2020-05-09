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
    return $user;
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
    $user_id = $user->id;
    //Validatie: velden mogen niet leeg zijn
    if(!empty($email) && !empty($password)){
        if(canLogin($email, $password)){
            session_start();
            $_SESSION['email'] = $email;
            
           
            header ("Location: index.php");
        }else{
            //User en password matchen niet
            //Error
            $error="Cannot log you in.";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Login</title>
</head>
<body>
<div class="container register-form">
  <div class="form"></div>
    <!--Error melding-->
    <?php if( isset($error) ): ?>
        <div class="alert alert-danger" role="alert">
            <p> <?php echo $error; ?> </p>
        </div>
        <?php endif;?>
    </div>
 
        <form action="" method="POST">
            <div class="form-content">  
            <div class="col-md-6">
                <div class="note col-md-6">
                    <p>Login</p>
                </div>  
                <!-- Email veld -->
                <div class="form-group col-md-6">
                    <input name="email" id="email" type="text" placeholder="Email" class= "form-control" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
           
                <!-- Password veld -->
                <div class="form-group col-md-6">
                    <input name="password" id="password" type="password" placeholder="Password" class= "form-control"  value="">
                </div>    
 
                <!--Login button-->
                <div class="form-group col-md-6">
                    <button type="submit" class="btnSubmit" style="border-radius: 20px; width: 150px;" >Login</button>
                        <br><br>
                        <!--onthoud mij checkbox-->  
                    <input type="checkbox" id="rememberMe"><label for="rememberMe" class="">Remember me</label>
                        <br>

                    <!--Nog geen account?-->
                    <p>Nog geen account? <a href="register.php">Register</a></p>    
                </div>
                </div>
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
