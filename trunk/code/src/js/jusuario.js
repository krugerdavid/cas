
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
    $("#usr_fecha_nac").mask("9999-99-99");

        $("#usr-form").validate({
        rules: {
            usr_nombres: {required: true, maxlength: 50, regex: "^[a-zA-Z ]+$"},
            usr_apellidos: {required: true, maxlength: 50, regex: "^[a-zA-Z ]+$"},
            usr_password: { minlength: 6, maxlength: 30 },
			usr_password_confirm: { minlength: 6, maxlength: 30, equalTo: "#usr_password" },
            usr_email: {email: true, maxlength: 30},
            usr_doc_num: {required: true, maxlength: 9, regex: "^[0-9]+$", min: 1},
            usr_fecha_nac: {required: true, fecha_valida:true, fecha_mayor:true},
            usr_lugar_nac: {maxlength: 50, regex: "^[0-9a-zA-Z -]+$"}

        },
        messages: {
            usr_nombres: {
                required: "Este campo no puede estar vacio",
                regex: "Solo se aceptan letras y espacios.",
                maxlength: "Se acepta un maximo de 50 caracteres."
            },
            usr_apellidos: {
                required: "Este campo no puede estar vacio",
                regex: "Solo se aceptan letras y espacios.",
                maxlength: "Se acepta un maximo de 50 caracteres."
            },
            usr_email: {email: "Ingrese una direccion de correo valida.",
                        maxlength: "Se acepta un maximo de 30 caracteres."},
            usr_password: {required: "Este campo no puede estar vacio.", maxlength: "Se acepta un maximo de 30 caracteres.",
                        minlength: "Debe tener un minimo de 6caracteres."},
            usr_password_confirm: { required: "Este campo no puede estar vacio", maxlength: "Se acepta un maximo de 30 caracteres.", minlength: "Debe tener un minimo de 6caracteres.", equalTo: "Debe coincidir con el campo Contraseña" },
            usr_doc_num: {required: "Este campo no puede estar vacio",
                          regex: "Este campo debe ser numerico",
                          maxlength: "Se acepta un maximo de 9 caracteres.",
                            min: "El numero de documento debe ser mayor a cero."},
            usr_fecha_nac: {required: "Este campo no puede ser vacio.",
                        regex: "El formato de fecha debe ser aaaa-mm-dd.",
                        fecha_valida: "La fecha ingresada no es valida.",
                        fecha_mayor: "La persona debe ser mayor de 21 años."},
            usr_lugar_nac: {maxlength: "Se acepta un maximo de 50 caracteres.",
                        regex: "Solo se aceptan letras y numeros."}
        },
        submitHandler: function(form) {
            var prsId = '';
            if ($("input[name='prs_id']").val() != undefined){
                prsId =$("input[name='prs_id']").val();
            }
            if ($("#usr_doc_num").val() != ''){
                $.post("http://localhost/cas/miembro/verificar_documento/",
                    { documento_numero: $("#usr_doc_num").val(), miembro_id: prsId},
                    function (data, textStatus) {
                         if (data.toString().indexOf('TRUE') > -1){
                            $('#documento_repetido').slideDown('fast');
                         }else{
                            form.submit();
                         }
                     },
                     "html");
            }else{
                form.submit();
            }
         }
    });


    $("#bt_cancel").click(function(){
       $(':input','#usr-form')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('selected');
            $("input[name='usr_casado']:nth(0)").attr('checked', 'checked');
    });

    $("#agregar_miembro").click(function(){
        window.location = base_url + 'miembro/agregar/';
    });

    $('#documento_repetido').slideUp('fast');

    $("#usr_doc_num").focus(function() {
        $('#documento_repetido').slideUp('fast');
    });
});
