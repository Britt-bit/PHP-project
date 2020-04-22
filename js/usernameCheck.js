$("#email").on("keyup", function(e){
    let email = $("#email").val();
    if (email.length >= 30) {
        $.ajax({
            method: "POST",
            url: "ajax/checkusername.php",
            data: { email: email},
            dataType:'json'
        })
            .done(function( res ) {
                if(res.status =="success"){
                    console.log(res.status);
                    $('#errorMessage').html('');
                    $('#errorMessage').html(`
                    <div class="alert alert-success" role="alert">
                        <p>This email has not been registered yet</p>
                    </div>
                    `);
                    
                } else {
                    console.log(res.status);
                    $('#errorMessage').html('');
                    $('#errorMessage').html(`
                    <div class="alert alert-danger" role="alert">
                        <p>This email has already been registered if this is your school adress contact Joris.</p>
                    </div>
                    `);
                }
            });
    }
    
    e.preventDefault();
});

