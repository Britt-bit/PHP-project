$(document).ready(function () {
$(".reaction").on("click", function () {
// Here we are getting the reaction which is tapped by using the data-reaction attribute defined in main page
var data_reaction = $(this).attr("data-reaction");
// Sending Ajax request in handler page to perform the database operations
$.ajax({
type: "POST",
url: "php/like.php",
data: "data_reaction=" + data_reaction,
success: function (response) {
// This code will run after the Ajax is successful
$(".like-btn-emo").removeClass().addClass('like-btn-emo').addClass('like-btn-' + data_reaction.toLowerCase());
 
if (data_reaction == "1")
$(".like-emo").html('<span class="like-btn-like"></span>');
else
$(".like-emo").html('<span class="like-btn-like"></span><span class="like-btn-' + data_reaction.toLowerCase() + '"></span>');
}
})
});
});