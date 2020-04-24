$("#sendRequest").on("click", function (e) {
    let id = $("#id").val();
    let uid = $("#uid").val();
    let email = $('#email').val();
    let person = $('#person').val();
    let uri = $("#uri").val();
    console.table(id, uid);
    
    $.ajax({
        method: "POST",
        url: "ajax/sendBuddyRequest.php",
        data: { id: id, uid: uid, email: email, person: person },
        dataType: 'json'
    })
        .done(function (res) {
            if (res.status == "success") {
                console.log(res.status);
                $("#requestBtn").load(uri + "#requestBtn");

            } else {
                console.log(res.status);
                $("#watchOut").show(); 
            }
        });

    e.preventDefault();
});

