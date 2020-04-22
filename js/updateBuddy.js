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
        $("#watchOutBuddy").hide();
    } else if ($(this).val() != 1) {
        $('#buddy').change(function () {
            if ($(this).val() != 1) {
                $("#watchOutBuddy").show();
            } 
            else{
                $("#watchOut").hide(); 
            }
        })
        $("#watchOut").hide();
        $("#watchOutBuddy").show();
    }

});