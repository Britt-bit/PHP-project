<?php 

//user email: britt@student.thomasmore.be --- --- --- password: Password123

//klasse en database copy pasten naar hier
include_once(__DIR__ . "./classes/User.php");
include_once(__DIR__ . "./classes/Db.php");

//connectie met de database
function canLogin($email, $password){
    $conn = Db::getConnection();
    $statement = $conn->prepare("select * from users where email = '$email'");
    $statement->execute();
    $user = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if(password_verify($password, $user['password'])){
        return true;
    }else{
        return false;
    }
}


//Get de User
$user = new User();
$getUser = $user->getUserById($_GET['id']);

//Error
$errors = [];

//Detecteer submit
if(!empty($_POST)){

  //Velden uitlezen in variabelen
  $email = $_POST['email'];
  $password = $_POST['password'];
    //Validatie: velden mogen niet leeg zijn
    if(!empty($email) && !empty($password)){
        //Indien OK: login checken
        //Onthouden dat User aangelogd is
        //Redirect naar index.php

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
    
    <div class="container">

    <!--Error melding-->
    <?php if(count($errors) >0):?>
    <div class="alert alert-danger mt-5">
        <?php foreach ($errors as $error):?>
        <?php echo $error; ?> <br>
        <?php endforeach?>
    
    </div>
    <?php endif;?>

        <div class="note">
            <p>Login</p>
        </div>

        <form action="" method="POST" >
            <div class="form-content">
                <!-- Email veld -->
                <div class="form-group row col-md-4 text-center">
                    <input name="email" id="email" type="text" placeholder="Email" value="<?php echo $getEmail['email']?>">
                </div>
            
                <!-- Password veld -->
                <div class="form-group row col-md-4 text-center">
                    <input name="passwors" id="passwors" type="text" placeholder="Password" value="<?php echo $getPassword['password']?>">
                </div>   

                <!--Login button-->
                <div class="form-group row col-md-4 text-center">
                    <button type="submit" class="btnSubmit">Login</button>
                    <br>
                     <!--onthoud mij checkbox-->   
                     <input type="checkbox" id="rememberMe"><label for="rememberMe" class="">Remember me</label>
                    <br>
                     <!--Password vergeten-->
                     <a href="">Forgotten password?</a>
                </div>
                

            </div>        
        </form>
    </div>
   
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>