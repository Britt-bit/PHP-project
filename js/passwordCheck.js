$("#confirmPassword").on("keyup", function (e) {
    let password = $("#newPassword").val();
    let confirmPassword = $('#confirmPassword').val();

     if (password == confirmPassword) {
         /* div succes */
         let passcheck = $(".passcheck");
         passcheck.html("Passwords match.");
         passcheck.addClass("alert alert-success");
         passcheck.removeClass("alert-danger");
     }
     else{
         let passcheck = $(".passcheck");
         passcheck.html("Passwords don't match.");
         passcheck.addClass("alert alert-danger");
         passcheck.removeClass("alert-succes");
     }              
})