jQuery.validator.setDefaults(
    {
        debug: true,
        //success: "valid"
        submitHandler: function(form) {
        // do other stuff for a valid form
        form.submit();
       }

    }
);

$(document).ready(function(){

    $("#form_audit").validate({
        rules: {
        },
        highlight: function(element, errorClass) {
            $(element).fadeOut(function() { $(element).fadeIn() })
        },
        messages: {
        },
        submitHandler: function(form) {
            form.submit();
         }
    });

    //en caso de que sea la pagina de agregar no queremos que se ejecute el evento
    var direccion = window.location.pathname;

});