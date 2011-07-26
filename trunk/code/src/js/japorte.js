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

function selectItem(li, elementID) {
	$("#"+elementID).val(0);
	var setVal = (li.extra) ? li.extra[1] : 0;
	$("#"+elementID).val(setVal);
}

$(document).ready(function(){

    $("#miembro_nombre").autocomplete("/cas2/aporte/miembro_nombre",
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


    $("#form_aporte").validate({
        rules: {
            miembro_nombre: { required: true, minlength: 2, maxlength: 150 },
            aporte_fecha: { required: true, regex: "^[0-9]{2}/[0-9]{2}/[0-9]{4}$"},
            aporte_monto: { required: true, minlength: 4, maxlength: 8, regex: "^[0-9]{0,8}$", numero_mayor: 0}
        },
        messages: {
            com_nombre: {
                required: "Este campo no puede estar vacio",
                minlength: "Tamanho minimo 2 caracteres",
                maxlength: "Tamanho maximo 50 caracteres"
            },
            aporte_fecha: {
                required: "Este campo no puede estar vacio",
                regex: "El formato de la fecha debe ser mm/dd/aaaa"
            },
            aporte_monto: {
                required: "Este campo no puede estar vacio",
                minlength: "Tamanho minimo 4 caracteres",
                maxlength: "Tamanho maximo 8 caracteres",
                regex: "Se aceptan solo numeros",
                numero_mayor: "El monto debe ser mayor a cero."
            }
        },
        submitHandler: function(form) {
            form.submit();
         }
    });

    $('#aporte_monto').numeric();

     $('#prompt').dialog({
         autoOpen: false,
		 width: 750,
         modal: true,
		 buttons: {
             "Ok": function() {
                 if (current_id != null & current_nombre != null){
                     $('#miembro_nombre').val(current_nombre);
                     $('#miembro_id').val(current_id);
                 }
                 $('#prompt').dialog("close");
			 },
			 "Cancel": function() {
                 $(this).dialog("close");
			 }
		 }
	 });

     $("#btn-search").click(function(){
         current_nombre = null;
         current_id = null;
         current_row = null;
        $.post("http://localhost/cas/aporte/buscar_nombre/",
                     { text_buscar: $("#text_buscar").val()},
                     function (data, textStatus) {
                         if (data.toString().indexOf('isEmpty') > -1){
                             $('#tabla-valores').html('<p>No se han encontrado resultados</p>');
                         }else{
                            $('#tabla-valores').html(data);
                         }
                        
                         //alert(textStatus);
                         //$('#wtf').html(data);
                        //$('#dialogComunidad').dialog("close");
                     },
                     "html");
    });

});