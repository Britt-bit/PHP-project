$("#AcceptRequest").on("click", function (e) {
    let id = $("#id").val();
    let uid = $("#uid").val();
    let uri = $("#uri").val();
    console.table(id, uid);
    
    $.ajax({
        method: "POST",
        url: "ajax/AcceptBuddyRequest.php",
        data: { id: id, uid: uid },
        dataType: 'json'
    })
        .done(function (res) {
            if (res.status == "success") {
                

            } else {
                console.log(res.status);
                $("#watchOut").show(); 
            }
        });
        e.preventDefault();
});

