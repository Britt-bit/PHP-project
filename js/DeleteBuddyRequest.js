$("#DeleteRequest").on("click", function (e) {
    let id = $("#id").val();
    let uid = $("#uid").val();
    console.table(id, uid);
    
    $.ajax({
        method: "POST",
        url: "ajax/DeleteBuddyRequest.php",
        data: { id: id, uid: uid },
        dataType: 'json'
    })
        .done(function (res) {
            if (res.status == "success") {
                console.log(res.status);
                

            } else {
                console.log(res.status);
               
            }
        });

    e.preventDefault();
});

