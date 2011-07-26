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

function hijo_a_miembro(miembro, hijo)
{
   if (window.confirm("Esta seguro de asignar como miembro a este hijo?")){
      window.location = base_url + 'miembro/hijo_a_miembro/' + miembro + '/' + hijo ;
   }
   return false;
}

$(document).ready(function(){
    $("#usr_fecha_nac").mask("9999-99-99");
    $("#usr_bautizado_fec").mask("9999-99-99");
    $("#usr_defunsion_fec").mask("9999-99-99");

    $("#usr-form").validate({
        rules: {
            usr_nombres: {required: true, maxlength: 50, regex: "^[0-9a-zA-Z -]+$"},
            usr_apellidos: {required: true, maxlength: 50, regex: "^[0-9a-zA-Z -]+$"},
            usr_email: {email: true, maxlength: 30},
            usr_domic: {maxlength: 50, regex: "^[0-9a-zA-Z -]+$"},
            usr_doc_num: {maxlength: 9, regex: "^[0-9]+$"},
            //usr_fecha_nac: {required: true, regex: "^[0-9]{4}-[0-9]{2}-[0-9]{2}$"},
            usr_fecha_nac: {fecha_valida: true, fecha_menor_miembro: true},
            usr_tel: {maxlength: 20, regex: "^[0-9 -]+$"},
            usr_lugar_nac: {maxlength: 50, regex: "^[0-9a-zA-Z -]+$"},
            usr_lugar_bautizado: {maxlength: 50, regex: "^[0-9a-zA-Z -]+$"},
            usr_bautizado_fec: {fecha_valida: true, fecha_camparar_menor: "usr_fecha_nac"},
            usr_defunsion_fec: {fecha_valida: true, fecha_camparar_menor: "usr_fecha_nac"},
            usr_obs: {maxlength: 100, regex: "^[0-9a-zA-Z\n -]+$"}
        },

        messages: {
            usr_nombres: {
                required: "Este campo no puede estar vacio",
                regex: "Solo se aceptan letras, numeros y espacios.",
                maxlength: "Se acepta un maximo de 50 caracteres."
            },
            usr_apellidos: {
                required: "Este campo no puede estar vacio",
                regex: "Solo se aceptan letras, numeros y espacios.",
                maxlength: "Se acepta un maximo de 50 caracteres."
            },
            usr_email: {email: "Ingrese una direccion de correo valida.",
                        maxlength: "Se acepta un maximo de 30 caracteres."},
            usr_doc_num: {//required: "Este campo no puede estar vacio",
                          regex: "Este campo debe ser numerico",
                          maxlength: "Se acepta un maximo de 9 caracteres."},
            usr_fecha_nac: {required: "Este campo no puede ser vacio.",
                        regex: "El formato de fecha debe ser aaaa-mm-dd.",
                        fecha_valida: "La fecha ingresada no es valida.",
                        fecha_menor_miembro: "La fecha debe ser como minimo 10 años mayor al miembro."},
            usr_domic: {maxlength: "Se acepta un maximo de 50 caracteres.",
                        regex: "Solo se aceptan letras y numeros."},
            usr_tel: {maxlength: "Se acepta un maximo de 20 caracteres.",
                        regex: "Solo se aceptan numeros."},
            usr_lugar_nac: {maxlength: "Se acepta un maximo de 50 caracteres.",
                        regex: "Solo se aceptan letras y numeros."},
            usr_lugar_bautizado: {maxlength: "Se acepta un maximo de 50 caracteres.",
                        regex: "Solo se aceptan letras y numeros."},
            usr_bautizado_fec: {fecha_valida: "formato de fecha invalida.",
                                fecha_camparar_menor:"fecha no puede ser menor a nacimiento."
                                //required: "Este campo no puede estar vacio"
                                },
            usr_defunsion_fec: {fecha_valida: "formato de fecha invalida.",
                                fecha_camparar_menor:"fecha no puede ser menor a nacimiento."},
            usr_obs: {maxlength: "Se acepta un maximo de 100 caracteres.",
                        regex: "Solo se aceptan numeros y letras."}
        },
        submitHandler: function(form) {
            var inputId = 'otro_id';
            if (window.location.href.indexOf('hijo') > -1){
                inputId = 'hijo_id';
            }

            if ($("#usr_doc_num").val() != ''){
                $.post("http://localhost/cas/miembro/verificar_documento/",
                    { documento_numero: $("#usr_doc_num").val(), miembro_id: $("input[name='"+inputId+"']").val()},
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

    if (window.location.href.indexOf('hijo_agregar') > -1){
        $("#usr-form").validate({
        rules: {
            usr_fecha_nac: {fecha_menor_miembro: true}
        },
        messages: {
            usr_fecha_nac: {fecha_menor_miembro: "La fecha debe ser como minimo 10 años mayor al miembro."}
        }});
    }
        

    $("#usr_bautizado_fec").change(function(){
        if ($("#usr_bautizado_fec").val() != ''){
            $("input[name='usr_bautizado']:nth(0)").attr('checked', 'checked');
        }
    });

    $("#usr_lugar_bautizado").change(function(){
        if ($("#usr_lugar_bautizado").val() != ''){
            $("input[name='usr_bautizado']:nth(0)").attr('checked', 'checked');
        }
    });

    $("#miembro_buscar_boton").click(function(){
        if ($("#miembro_buscar").val() != '')
            window.location = base_url + 'miembro/buscar/' + $("#miembro_buscar").val();
        //alert('llamo');
    });

    $("#agregar_miembro").click(function(){
        window.location = base_url + 'miembro/agregar/';
        //alert('llamo');
    });

    $("#miembro_buscar").keyup(function(e) {
        if(e.keyCode == 13) {
            if ($("#miembro_buscar").val() != '')
                window.location = base_url + 'miembro/buscar/' + $("#miembro_buscar").val();
        }
    });

    $("#bt_cancel").click(function(){
       $(':input','#usr-form')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    });

    $("#agregar_miembro").click(function(){
        window.location = base_url + 'miembro/agregar/';
    });

    $("#img-personales").click(function(){
        if ($("#div-personales").css('display') == 'none'){
            $("#div-personales").slideDown("fast");
            $("#img-personales").attr("src", base_url+"images/right.gif");
        }else{
            $("#div-personales").slideUp("fast");
            $("#img-personales").attr("src", base_url+"images/down.gif");
        }
    });

    $("#img-ubicacion").click(function(){
        if ($("#div-ubicacion").css('display') == 'none'){
            $("#div-ubicacion").slideDown("fast");
            $("#img-ubicacion").attr("src", base_url+"images/right.gif");
        }else{
            $("#div-ubicacion").slideUp("fast");
            $("#img-ubicacion").attr("src", base_url+"images/down.gif");
        }
    });

    $("#img-bautismo").click(function(){
        if ($("#div-bautismo").css('display') == 'none'){
            $("#div-bautismo").slideDown("fast");
            $("#img-bautismo").attr("src", base_url+"images/right.gif");
        }else{
            $("#div-bautismo").slideUp("fast");
            $("#img-bautismo").attr("src", base_url+"images/down.gif");
        }
    });

    $("#img-observaciones").click(function(){
        if ($("#div-observaciones").css('display') == 'none'){
            $("#div-observaciones").slideDown("fast");
            $("#img-observaciones").attr("src", base_url+"images/right.gif");
        }else{
            $("#div-observaciones").slideUp("fast");
            $("#img-observaciones").attr("src", base_url+"images/down.gif");
        }
    });

    $('#documento_repetido').slideUp('fast');

    $("#usr_doc_num").focus(function() {
        $('#documento_repetido').slideUp('fast');
    });



});

// $('#fechayeah').datepicker();

    // // Dialog
    // $('#dialogsss').dialog({
        // autoOpen: false,
		// width: 600,
		// buttons: {
            // "Ok": function() {
                // $(this).dialog("close");
			// },
			// "Cancel": function() {
                // $(this).dialog("close");
			// }
		// }
	// });

    // $('#dialog_link').click(function(){
					// $('#dialogsss').dialog('open');
					// return false;
				// });

    // $('#dialogComunidad').dialog({
        // autoOpen: false,
		// width: 400,
		// buttons: {
            // "Ok": function() {
                // $.post("http://localhost/cas/admin/respuesta",
                    // { primervalor: $("#com_nombre").val(), segundovalor: "cambiado"},
                    // function (data, textStatus) {
                        // //$('#loco').html(data);
                        // alert(textStatus);
                        // $('#wtf').html(data);
                        // //$('#dialogComunidad').dialog("close");
                    // },
                    // "html");
			// },
			// "Cancel": function() {
                // $(this).dialog("close");
			// }
		// }
	// });

    // // Dialog Link

			// $('#dialogComlink').click(function(){
					// $('#dialogComunidad').dialog('open');
					// return false;
				// });
    // $("#llamada").click(function(){
     // $("#ajaxForm").load("http://localhost/cas/admin/respuesta",
                        // "",
                        // function (responseText, textStatus, XMLHttpRequest) {
                            // alert(responseText);
                        // });
    // });

    // $("#jijijojo").click(function(){
     // $.post("http://localhost/cas/admin/respuesta",
        // { primervalor: $("#opcionnueva").val(), segundovalor: "cambiado"},

                        // function (data) {
                            // $('#loco').html(data);
                            // alert(data);
                        // }, "html");
    // });

    // $("#otromas").click(function(){
        // $('#loco').append('<option value="1">test 1</option><option value="3">test 3</option><option value="3">test 3</option>');
    // });

    //$("#pselect").change(function () {
      //  alert($("#pselect").attr("value"));
        //$.prompt('Example 1');
    //});
    //$("#pselect").attr("value","1");

