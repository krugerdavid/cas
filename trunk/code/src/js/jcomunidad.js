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
    
    document.getElementById('com_nombre').value = desc;
    document.getElementById('com_codigo').value = id;
    document.getElementById('form_comunity').action = base_url + 'comunidad/editar/';
}

function agregar_comunidad(){
    document.getElementById('com_nombre').value = "";
    document.getElementById('com_codigo').value = "";
    document.getElementById('form_comunity').action =  base_url + 'comunidad/insertar/';
}

function selectItem(li, elementID) {
	$("#"+elementID).val(0);
	var setVal = (li.extra) ? li.extra[1] : 0;
	$("#"+elementID).val(setVal);
}

  
$(document).ready(function(){
    $("#agregar_comunidad").click(function () {
        $("#basic").slideDown("slow");
    });

    $("#cancelar").click(function(){
        $("#basic").slideUp("slow");
    });

    $("#miembro_nombre").autocomplete("/cas/aporte/miembro_nombre",
        { minChars:3, 
          matchSubset:1,
          matchContains:0,
          cacheLength:10,
          mustMatch:0,
          selectOnly:1,
            elementID:'miembro_id',
            onItemSelect:selectItem
        }
     );

     $("#aporte_fecha").datepicker({altField: '#aporte_fecha_server', altFormat: 'yy-mm-dd' });
     //$('#aporte_fecha').datepicker('option', 'altFormat', 'yyyy-mm-dd');


    $("#form_comunity").validate({
        rules: {
            com_nombre: { required: true, minlength: 2, maxlength: 50,  regex: "^[0-9a-zA-Z -]+$"}
        },
        messages: {
            com_nombre: {
                required: "Este campo no puede estar vacio",
				regex: "Solo se aceptan espacios, numeros y letras",
                minlength: "Tamanho minimo 2 caracteres",
                maxlength: "Tamanho maximo 50 caracteres"
            }
        },
        submitHandler: function(form) {
           // alert($("select[name='dto_id']").val());
           // return;
                $.post("http://localhost/cas/comunidad/verificar_comunidad/",
                    { com_nombre: $("#com_nombre").val(), com_codigo: $("input[name='com_codigo']").val(), dto_id: $("select[name='dto_id']").val()},
                    function (data, textStatus) {
                         if (data.toString().indexOf('TRUE') > -1){
                            $('#documento_repetido').slideDown('fast');
                            //alert(data.toString());
                         }else{
                            // alert(data.toString());
                           form.submit();
                         }
                     },
                     "html");
            
         }
    });

    $("#com_buscar").keyup(function(e) {
        if(e.keyCode == 13) {
            if ($("#com_buscar").val() != '')
                window.location = base_url + 'comunidad/buscar/' + $("#com_buscar").val();
        }
    });

    $('#documento_repetido').slideUp('fast');

    $("#com_nombre").focus(function() {
        $('#documento_repetido').slideUp('fast');
    });


    //en caso de que sea la pagina de agregar no queremos que se ejecute el evento
    //var direccion = window.location.pathname;
    //if (direccion.indexOf('agregar') == -1)
    //{
    //    agregar_comunidad();
    //}
    //else
    //{
    //    document.getElementById('form_comunity').action =  base_url + '/comunidad/insertar/';
    //    $("#basic").slideDown("fast");
    //}
    
});