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

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Por favor verificar el formato del campo."
    );


    $("#form_rol").validate({
        rules: {
            rol_nombre: { required: true, minlength: 2, maxlength: 50, regex: "^[a-zA-Z0-9 ]*$"},
            pselect: {required: true}
        },
        highlight: function(element, errorClass) {
            $(element).fadeOut(function() { $(element).fadeIn() })
        },
        messages: {
            rol_nombre: {
                required: "Este campo no puede estar vacio",
                minlength: "Tamanho minimo 2 caracteres",
                maxlength: "Tamanho maximo 50 caracteres",
                regex: "Solo se admiten letras y numeros"
            },
            pselect: { required: "lo necesito pibe"}
        },
        submitHandler: function(form) {
            form.submit();
         }
    });

    //$("#pselect").change(function () {
      //  alert($("#pselect").attr("value"));
        //$.prompt('Example 1');
    //});
    //$("#pselect").attr("value","1");

});