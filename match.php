<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
//klasse en database copy pasten naar hier
include_once(__DIR__ . "/classes/User.php");
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ ."/classes/Features.class.php");
include_once(__DIR__ ."/classes/Match.php"); 
$conn = Db::getConnection();

//if(isset($_GET['chat'])){
//    $id = $_GET['chat'];
    
//    $result = $conn->prepare("SELECT * FROM user WHERE user_id=:id");
//    $result->bindParam(':id', $id);
//    $result->execute();
//    if (count($result) ==1){
//        $row = $result->fetchAll();

        //var_dump($yourID);
//    }
//}

$qry = $conn->prepare("SELECT `name` FROM `buddyChat`, `reaction` WHERE buddyChat.reaction_id = reaction.reaction_id AND buddyChat.reaction_id = :name");
$qry->bindParam(':name', $reactionID);
$qry->execute();
$emoji = $qry->fetch(PDO::FETCH_COLUMN);


//$statementChat = $conn->prepare("INSERT INTO buddyChat (reaction_id) 
//VALUES (:reaction_id)");

//$statementChat->bindValue(":reaction_id", '+data_reaction');
//$statementChat->execute();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/match.css">
    <link rel="stylesheet" href="css/reaction.css">


    <title>My matches</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jquery.min.js"></script>
<script src="js/jquery.livequery.js"></script>
<script src="js/jquery.tooltipsterReaction.js"></script>
<script src="js/jquery.tipsy.js"></script>

</head>

<body>

<a href="index.php"><img class="logo" src="./images/logo.png" alt="Buddiez logo"></a>

   <!--navigatie-->        
    <nav>
    <a href="index.php?id=<?php $_SESSION['user_id'][0] ?>">Home</a>
    <a href="profile.php?id=<?php $_SESSION['user_id'][0] ?>">Profile</a>
    <a href="buddy.php?id=<?php $_SESSION['user_id'] ?>">My buddies</a>
    <a style="color: rgb(245, 134, 124);"href="match.php?id=<?php $_SESSION['email'] ?>">My matches</a>
    <a href="logout.php" class="logout">Logout</a>
    </nav>

    <form class="myMatches"method="POST">
    <h1>My matches</h1>
    <table>
        <tr>
            <!-- Alle mogelijke matches oplijsten
            Is nog niet verdeeld in buddy of geen buddy-->
        <?php 
        //features van alle andere gebruikers ophalen
        while($yourFeature = $statement->fetch( PDO::FETCH_ASSOC )){ 
            //loopen over alle mogelijke gebruikers in de database
            for ($counter = 0; $yourFeature = $statement->fetch( PDO::FETCH_ASSOC ); ++$counter){
                $yourGame = $yourFeature['games']; 
                $yourFilm = $yourFeature['films'];
                $yourMusic = $yourFeature['muziek']; 
                $yourCourse = $yourFeature['vak'];
                $yourHobby = $yourFeature['hobby']; 
                $yourName = $yourFeature['firstname'];
                $yourLastname = $yourFeature['lastname'];
                $yourEmail = $yourFeature['email'];
                $yourBuddy = $yourFeature['buddy'];

                $stmt = $conn->prepare("SELECT `user_id` FROM `user` WHERE email = :yourEmail");
                $stmt->bindParam(':yourEmail', $yourEmail);
                $stmt->execute();
                $yourID = $stmt->fetch(PDO::FETCH_COLUMN);

                //al deze features in een 2de array zetten
                $yourFeatureArray = array($yourGame, $yourFilm, $yourMusic, $yourCourse, $yourHobby);
                //De 2 arrays vergelijken om te zien welke features allemaal matchen.
                $result = array_intersect($myFeatures, $yourFeatureArray);


                $stmtStatus = $conn->prepare("SELECT `status` FROM `buddyChat`, `user` WHERE buddyChat.from_user_id = user.user_id AND buddyChat.from_user_id = $yourID AND `status` = 1");
                $stmtStatus->execute();
                $status = $stmtStatus->fetch(PDO::FETCH_COLUMN);
                //var_dump($status);


            if($yourBuddy != $buddy){
                if($yourID != $id){
                //als er 5 dezelfde features zijn ... 
                if(count($result) === 5){
                    echo "<br/>";
                    echo "<br/>";
                    print("You matched with " . htmlspecialchars($yourName) . " " . htmlspecialchars($yourLastname) . " on the features "); 
                        for($tel = 0; $tel < sizeof($result); ++$tel){
                            if($tel < sizeof($result) -1){
                                echo(htmlspecialchars($result[$tel]) . ", ");
                            } else {
                                echo(htmlspecialchars($result[$tel]) . ".");
                            }

                        }
                        if($status == 1){
                            $statusReturn = '<p>New message</p>';
                         } else {
                             $statusReturn = "";
                         }
                    echo '<button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'. $yourID . '" data-tousername="'. $yourName . '">Start Chat '.$statusReturn.'</button>';
                    
                ?>
            </tr>
            <?php
                }else if(count($result) === 4){
                    echo "<br/>";
                    echo "<br/>";
                    print("You matched with " . htmlspecialchars($yourName) . " " . htmlspecialchars($yourLastname) . " on the features "); 
                    for($tel = 0; $tel < sizeof($result) +2; ++$tel){
                        echo(htmlspecialchars($result[$tel]) . "  ");
                    }
                    if($status == 1){
                        $statusReturn = '<p>New message</p>';
                     } else {
                         $statusReturn = "";
                     }
                    echo '<button type="button" class="startChat start_chat" data-touserid="'. $yourID . '" data-tousername="'. $yourName . '">Start Chat'.$statusReturn.'</button>';
                   
            ?>
            </tr>
            <?php
                } else if(count($result) === 3){
                    echo "<br/>";
                    echo "<br/>";
                    //<p style='margin-left:20px';> 
                    echo("You matched with " . htmlspecialchars($yourName) . " " . htmlspecialchars($yourLastname) . " on the features "); 
                    for($tel = 0; $tel < sizeof($result) +2; ++$tel){
                        echo(htmlspecialchars($result[$tel]) . " ");  
                         
                    }
                    //echo("</p>");
                    if($status == 1){
                        $statusReturn = '<p>New message</p>';
                        
                     } else {
                         $statusReturn = "";
                     }
                echo '<button type="button" class="startChat start_chat" data-touserid="'. $yourID . '" data-tousername="'. $yourName . '">Start Chat'.$statusReturn.'</button>';
                
  
            ?>
            </tr>
            <?php
            }
        }
    }
    }
    }
?>
</table>
</form>

<div class="table-responsive">
    <div id="user_model_details"></div>
    <div id="status_content"></div>
</div>

<!--<script src="js/reaction.js"></script>-->

<script>
    $(document).ready(function(){
        event.preventDefault()
        setInterval(function(){
            update_chat_history_data();
        }, 5000);

function show_status_content(to_user_id){
    var modal_content = modal_content += '<p>You have a new message</p>';
    $('#status_content').html(modal_content);
}

function make_chat_dialog_box(to_user_id, to_user_name){
    var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Je chat met '+to_user_name+'">';
    modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
    modal_content += fetch_user_chat_history(to_user_id);
    modal_content += '</div>';
    modal_content += '<div class="form-group">';
    modal_content += '<textarea  name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control"></textarea>';
    modal_content += '</div><div class="form-group" align="right">';
    
    modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
    $('#user_model_details').html(modal_content);
}

var buttonclicked
$(document).on('click', '.reaction', function(e) {   // like click
    console.log(e);
    var data_reaction = $(this).attr('data_reaction');
    var message_id = $(this).attr('message_id');

        //alert("Button is clicked for first time "+data_reaction + " " + message_id);
        $.ajax({
        url: "php/like.php",
        type: "POST",
        data:{
            data_reaction: data_reaction,
            message_id: message_id
        },
        success: function (response) {
            var data_reaction = $(this).attr("data_reaction");
            var message_id = $(this).attr("message_id");
        }
    })

    //
});



$(document).on('click', '.start_chat', function(){
    var to_user_id = $(this).data('touserid');
    var to_user_name = $(this).data('tousername');
    make_chat_dialog_box(to_user_id, to_user_name);
    $("#user_dialog_"+to_user_id).dialog({
        autoOpen:false,
        width:400
    });
$('#user_dialog_'+to_user_id).dialog('open');
});

$(document).on('click', '.send_chat', function(){
    event.preventDefault()
    //alert("hi");
    var to_user_id = $(this).attr('id');
    var chat_message = $('#chat_message_'+to_user_id).val();
    
    $.ajax({
     url:"php/insert_chat.php",
     method:"POST",
     data:{to_user_id:to_user_id, chat_message:chat_message},
     success:function(data)
     {
      $('#chat_message_'+to_user_id).val('');
      $('#chat_history_'+to_user_id).html(data);
     }
    })
   });

   function fetch_user_chat_history(to_user_id){
            $.ajax({
            url:"php/Fetch_chat_history.php",
            method:"POST",
            data:{to_user_id:to_user_id},
            success:function(data){
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    }

    function update_chat_history_data(){
            $('.chat_history').each(function(){
                var to_user_id = $(this).data('touserid');
                fetch_user_chat_history(to_user_id);
            });
        }

        $(document).on('click', '.ui-button-icon', function(){
            $('.user_dialog').dialog('destroy').remove();
        });



});
</script>
</body>
</html>
