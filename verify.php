<?php
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");

if (isset($_GET['vkey'])){
    //Process Verification
    $vkey = $_GET['vkey'];

    $conn = Db::getConnection();
            
    $statement = $conn->prepare("SELECT `verified`, `vkey` FROM `user` WHERE `verified` = 0 AND `vkey` = :vkey LIMIT 1");

            //$vkey = $this->getVkey();
    $statement->bindValue(":vkey", $vkey);
    $result = $statement->execute();
    $count = count($result);
    //$result->fetch(PDO::count($result));

    //$result = $result->execute();
    var_dump($result);
    var_dump($count);

            
    if($count == 1){
        $update = $conn->prepare("UPDATE `user` SET `verified` = 1 WHERE `vkey` = :vkey LIMIT 1");
        var_dump($vkey);
        $update->bindValue(":vkey", $vkey);
        var_dump($update);
        $verified = $update->execute();
        var_dump($verified);
        return $verified;
        var_dump("It's alright");
    } else {
        var_dump("This account invalid or already verified");
    }

    //var_dump($vkey);

    // via classes in de databank updaten
    // -> (update user set verified = 1 where vkey = $vkey limit 1)
    //$verified = User::verified();
    //var_dump ($verified);
} else {
    die("Something went wrong");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
</head>
<body>
    <p>Thank you for registering. We have sent a verification email to the address provided.</p>

</body>
</html>