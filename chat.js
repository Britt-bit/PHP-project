document.querySelector("#send").addEventListener("click", function(){
    //alert("Hi!");

    //doorgeven over welke post het gaat -> postid?
    let send = this.dataset.buddyChat;
    let message = document.querySelector("#message").value;

    console.log(send);
    console.log(message);


    //post naar database (AJAX)
    let formData = new FormData();

    formData.append("send", send);
    formData.append("message", message);

    fetch("ajax/saveMessage.php",{
        method: "POST",
        body: formData

    })
        .then(response => response.json())
        .then(result => {
            console.log("Succes:", result);
        })
        .catch(error=>{
            console.error("Error:", error);
        });
 

    //antwoord ok? Toon bovenaan?
});