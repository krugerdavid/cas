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

function editar_confesion(id, desc){

    $("#basic").slideDown("slow");

    document.getElementById('con_nombre').value = desc;
    document.getElementById('con_codigo').value = id;
    document.getElementById('form_confetion').action = base_url + 'confesion/editar/';
}

function agregar_confesion(){
    document.getElementById('con_nombre').value = "";
    document.getElementById('con_codigo').value = "";
    document.getElementById('form_confetion').action =  base_url + 'confesion/insertar/';
}

$(document).ready(function(){
    $("#agregar_confesion").click(function () {
        $("#basic").slideDown("slow");
    });

    $("#cancelar").click(function(){
        $("#basic").slideUp("slow");
        });

    $("#con_buscar").keyup(function(e) {
        if(e.keyCode == 13) {
            if ($("#con_buscar").val() != '')
                window.location = base_url + 'confesion/buscar/' + $("#con_buscar").val();
        }
    });

    $("#form_confetion").validate({
        rules: {
             con_nombre: { required: true, minlength: 2, maxlength: 50 }
        },
        highlight: function(element, errorClass) {
            $(element).fadeOut(function() { $(element).fadeIn() })
            },

        messages: {
            con_nombre: {
                required: "Este campo no puede estar vacio",
                minlength: "Tamanho minimo 2 caracteres",
                maxlength: "Tamanho maximo 50 caracteres"
            }
        },
       submitHandler: function(form) {
           // alert($("select[name='dto_id']").val());
           // return;
                $.post("http://localhost/cas/confesion/verificar_confesion/",
                    { con_nombre: $("#con_nombre").val(), con_codigo: $("#con_codigo").val()},
                    function (data, textStatus) {
                         if (data.toString().indexOf('TRUE') > -1){
                            $('#documento_repetido').slideDown('fast');
                            //alert(data.toString());
                         }else{
                             //alert(data.toString());
                           form.submit();
                         }
                     },
                     "html");

         }
    });

    //en caso de que sea la pagina de agregar no queremos que se ejecute el evento
    var direccion = window.location.pathname;
    if (direccion.indexOf('agregar') == -1)
    {
        agregar_confesion();
    }
    else
    {
        document.getElementById('form_confetion').action =  base_url + '/confesion/insertar/';
        $("#basic").slideDown("fast");
    }

    $('#documento_repetido').slideUp('fast');

    $("#con_nombre").focus(function() {
        $('#documento_repetido').slideUp('fast');
    });
});