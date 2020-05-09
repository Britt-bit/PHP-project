$("#sendRequest").on("click", function (e) {
    let id = $("#id").val();
    let uid = $("#uid").val();
    let email = $("#email").val();
    let person = $("#fullname").text();
    let uri = $("#uri").val();
    console.table(id, uid, person, uri);
    
    $.ajax({
        method: "POST",
        url: "ajax/sendBuddyRequest.php",
        data: { id: id, uid: uid,person: person , email: email},
        dataType: 'json'
    })
        .done(function (res) {
            if (res.status == "success") {
                console.log(res.status);
                $(".container").load("profile.php?id=" + id);

            } else {
                console.log(res.status);
                $("#watchOut").show(); 
            }
        });

    e.preventDefault();
});

