$("#hobby").keyup(function(){ //keyup=wanneer toets released is, wanneer dit gebeurt=>function

   //verwijder whitespace van string(begin en einde)
   //.val()=>krijg value van input
    var hobby = $(this).val().trim();
  
    if(hobby != ''){
  
       $.ajax({
          url: 'ajax/sameHobby.php', //verzend request naar deze page
          method: 'post', //Verzendt gegevens -> verwerkt in opgegeven bron
          data: {hobby:hobby}, //key + value
          
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
