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

function editar_comunidad(id, desc){

    $("#basic").slideDown("slow");

    document.getElementById('rlc_nombre').value = desc;
    document.getElementById('rlc_codigo').value = id;
    document.getElementById('form_relacion').action = base_url + 'admin/editar_relacion/';
}

function agregar_comunidad(){
    document.getElementById('rlc_nombre').value = "";
    document.getElementById('rlc_codigo').value = "";
    document.getElementById('form_relacion').action =  base_url + 'admin/insertar_relacion/';
}

$(document).ready(function(){
    $("#agregar_relacion").click(function () {
        $("#basic").slideDown("slow");
    });

    $("#cancelar").click(function(){
        $("#basic").slideUp("slow");
    });

    $("#form_relacion").validate({
        rules: {
            rlc_nombre: { required: true, minlength: 2, maxlength: 50 }
        },
        highlight: function(element, errorClass) {
            $(element).fadeOut(function() { $(element).fadeIn() })
        },
        messages: {
            rlc_nombre: {
                required: "Este campo no puede estar vacio",
                minlength: "Tamanho minimo 2 caracteres",
                maxlength: "Tamanho maximo 50 caracteres"
            }
        },
        submitHandler: function(form) {
            form.submit();
         }
    });

    //en caso de que sea la pagina de agregar no queremos que se ejecute el evento
    var direccion = window.location.pathname;
    if (direccion.indexOf('agregar') == -1)
    {
        agregar_comunidad();
    }
    else
    {
        document.getElementById('form_relacion').action =  base_url + '/admin/insertar_relacion';
        $("#basic").slideDown("fast");

    }

});