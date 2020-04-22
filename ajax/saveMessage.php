<?php 

include_once(__DIR__ . "/../classes/chat.php");


session_start();
if(isset($_SESSION['email'])){
    echo $_SESSION['email'];
}


//if(!empty($_POST)){
    //nieuw comment
//    $c = new Comment();
//    $c->setSend($_POST['send']);
//    $c->setMessage($_POST['message']);
//    $c->setUser_id($_POST["user_id"]); //Data uit session object
    //save()
//    $c->save();
    //succes teruggeven
//    $response = [
//        'status'=>'succes',
//        'body' => htmlspecialchars($c->getMessage()),
//        'message' => 'Comment saved'
//    ];

//    header('Content-Type: application/json');
//    echo json_encode($response); 
//}

?>
<script>
    
    
</script>