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
      $response = "<span style='color: green; margin-left: 50px;'>$count gebruiker heeft dezelfde hobby als u.</span>";
   }

   if($count > 1){
    $response = "<span style='color: green; margin-left: 50px;'>$count gebruikers hebben dezelfde hobby als u.</span>";
 }


   echo $response;
   exit; 
   

}
