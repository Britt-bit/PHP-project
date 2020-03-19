<?php
include_once(__DIR__ ."/classes/User.php");
    if(!empty($_POST)){

        try {
        $user = new User();
        $user->setFirstname($_POST['firstname']);
        $user->setLastname($_POST['lastname']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

            if(!empty($firstname) || !empty($lastname)  || !empty($email) || !empty($password)){
                if($user->setEmail($_POST['email'] == "@student.thomasmore.be")){
                    //email eindigd op @student.thomasmore.be
                    $user->save();
                    $succes = "User saved";
                
                    header("Location: index.php");
                } else {
                    $error = $th->getMessage();
                } 
                } else {
                    $error = $th->getMessage();
                } 
            
    } catch (\Throwable $th){
        $error = $th->getMessage();
    }
    }

    $users = User::getAll();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/register.css">
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
                                <input name="firstname" id="firstname" type="text" class="form-control" placeholder="Your Name *" value=""/>
                            </div>
                            <div class="form-group">
                                <input name="lastname" id="lastname" type="text" class="form-control" placeholder="Your lastname *" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input name="email" id="email" type="text" class="form-control" placeholder="Your email *" value=""/>
                            </div>
                            <div class="form-group">
                                <input name="password" id="password" type="text" class="form-control" placeholder="Your Password *" value=""/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btnSubmit">Sign me up</button>
                    <?php if( isset($error) ): ?>
				<div class="form__error">
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