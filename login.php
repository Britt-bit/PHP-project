<?php 

include_once(__DIR__ . "/classes/User.php");

//detecteer submit
    
    //velden uitlezen in variabelen
    //validatie: velden mogen niet leeg zijn
    
        //indien OK: login checken
        //onthouden dat user aangelogd is
        //redirect naar index.php
        
        //indien leeg: error genereren


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
    
    <div class = "container register-form">
        <div class="form">

            <div class="note"><p>Login to your account</p></div>

            <form action="" method="POST">
            
                <div class="col-md-6">
                            <div class="form-group">
                                <input name="email" id="email" type="text" class="form-control" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/>
                            </div>

                            <div class="form-group">
                                <input name="password" id="password" type="password" class="form-control" placeholder="Password" value=""/>
                            </div>                            
                </div>

                <div>
                     <button type="submit" class="btnSubmit">Login</button>
                     <br>
                     <input type="checkbox" id="rememberMe"><label for="rememberMe" class="">Remember me</label>
                     <br>
                     <a href="">Forgotten password?</a>

                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>