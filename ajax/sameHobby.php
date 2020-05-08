<?php

include_once '../classes/Db.php';
include_once '../classes/Features.class.php';




if(isset($_POST['hobby'])){
   $hobby = $_POST['hobby'];

   $count = feature::sameHobby($hobby);

   if($count == 0){
    $response = "<span></span>";
 }
   
   if($count == 1){
      $response = "<span style='color: green; margin-left: 50px;'>$count user has the same hobby as you.</span>";
   }

   if($count > 1){
    $response = "<span style='color: green; margin-left: 50px;'>$count users have the same hobby as you.</span>";
 }


   echo $response;
   exit; 
   

}
