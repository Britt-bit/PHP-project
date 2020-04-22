$("#year").change(function () {
    if ($(this).val() == 1) {
        $('#buddy').change(function () {
            if ($(this).val() == 1) {
                $("#watchOut").show();
            }
            else{
                $("#watchOut").hide(); 
            }
        })
        $("#watchOut").show(); 
    } else {
        $("#watchOut").hide();
    }

});