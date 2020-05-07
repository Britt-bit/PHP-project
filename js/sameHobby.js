$("#hobby").keyup(function(){

    var hobby = $(this).val().trim();
  
    if(hobby != ''){
  
       $.ajax({
          url: 'ajax/sameHobby.php',
          type: 'post',
          data: {hobby:hobby},
          success: function(response){
  
             // Show response
             $("#hobbyCount").html(response);
  
          }
       });
    }else{
       $("#hobbyCount").html("");
    }
  
  });
  
  ;
