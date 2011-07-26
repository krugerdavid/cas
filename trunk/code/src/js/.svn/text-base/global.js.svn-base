/* 
 * Funciones globales para la aplicaciones
 */

function logout(){
	if(confirm("¿Está seguro/a de querer salir?")){
		window.location = base_url + 'logout/'
	}
}

function usuario_do_delete(id){
	if(confirm('¿Está seguro de querer eliminar este usuario?\nEl proceso es irreversible.')){
		window.location = base_url + 'admin/eliminar_usuario/' + id;
	}
}

function cmn_do_delete(id){
	if(confirm('¿Está seguro de querer eliminar esta Comunidad?\nEl proceso es irreversible.')){
		window.location = base_url + 'comunidad/eliminar/' + id;
	}
}

function cnf_do_delete(id){
	if(confirm('¿Está seguro de querer eliminar esta Confesion?\nEl proceso es irreversible.')){
		window.location = base_url + 'confesion/eliminar/' + id;
	}
}


// cambia el estado de todos los checkboxs pertenecientes a pID
function jqCheckAll( id, pID )
{
   $( "#" + pID + " :checkbox").attr('checked', $('#' + id).is(':checked'));
}

function jqCheckParent( id, pID)
{
  $("#" + pID + "[type='checkbox']").attr('checked', $('#' + id+ "[type='checkbox']").is(':checked'));
}



//funcion javascript utilizada por el validator para controlar fechas
function verificarFecha(fecha){
  if (typeof(fecha) != "undefined"){
      if (fecha == '')
          return true;

      var anio  =  parseInt(fecha.substring(0,4),10);
      var mes  =  parseInt(fecha.substring(5,7),10);
      var dia =  parseInt(fecha.substring(8),10);

      anhoMinimo  = 1900;
      if (anio > server_year || anio < anhoMinimo)
           return false;

      switch(mes){
          case 1:
          case 3:
          case 5:
          case 7:
          case 8:
          case 10:
          case 12:
              numDias=31;
              break;
          case 4: case 6: case 9: case 11:
              numDias=30;
              break;
          case 2:
              if (anhoBisisesto(anio)){ numDias=29 }else{ numDias=28};
              break;
          default:
              return false;
      }
          if (dia>numDias || dia==0){
              return false;
          }
          return true;
      }else{
          return true;
      }
}

function comparar_fechas(fecha1, fecha2)
{
  fecha_date1 = obtener_date(fecha1);
  fecha_date2 = obtener_date(fecha2);

  if (fecha_date1 == null || fecha_date2 == null)
      return null;

  NumDias = (fecha_date1.getTime()/86400000)-(fecha_date2.getTime()/86400000);

  return Math.round(NumDias);
}

function comparar(fecha)
{
  var fechaee = server_year + "-" + server_month + "-" + server_day;
  comparar_fechas(fecha,fechaee);
}

function obtener_date(fecha)
{
  if (verificarFecha(fecha) == false)
      return null;

    fecha_array = fecha.split("-");
    fecha_result = new Date()
    fecha_result.setYear(fecha_array[0]);
    fecha_result.setMonth(fecha_array[1]);
    fecha_result.setDate(fecha_array[2]);
    fecha_result.setHours(0);
    fecha_result.setMinutes(0);
    fecha_result.setSeconds(0);

    return fecha_result;
}

function anhoBisisesto(anio){
  if ( ( anio % 100 != 0) && ((anio % 4 == 0) || (anio % 400 == 0)))
      return true;
  else
      return false;
}

//agregar al validador atributo personalizado para control de fechas
 $.validator.addMethod("fecha_valida",
     function(value, element) {
         //comparar(value);
          return verificarFecha(value);
      }
 );

//se agrega un validador que indica si el campo es mayor de edad
 $.validator.addMethod("fecha_mayor",
     function(value, element) {
         if (value == '') return true;

         if (verificarFecha(value) == false)
             return false;

         var diferencia_cliente = comparar_fechas(value, fecha_server);
         var diferencia_mayoria = comparar_fechas(fecha_server, server_mayor_edad);

         if (diferencia_cliente >= 0)
             return false
         else{
             diferencia_cliente = diferencia_cliente * -1;

             if (diferencia_cliente >= diferencia_mayoria)
                 return true;
             else
                 return false;
         }
      }
 );

 //se agrega un validador que indica si el campo es mayor de edad
 $.validator.addMethod("fecha_menor_miembro",
     function(value, element) {
         //alert('sale'+miembro_fecha+'='+fecha_minima_edad_hijo);
         if (window.location.href.indexOf('hijo') < 0){
             return true;
         }
         
         if (value == '') return true;

         if (verificarFecha(value) == false)
             return false;

         var diferencia_cliente = comparar_fechas(value, miembro_fecha);
         var diferencia_mayoria = comparar_fechas(fecha_minima_edad_hijo, miembro_fecha);

         if (diferencia_cliente <= 0){
             //alert('sale'+miembro_fecha+'='+fecha_minima_edad_hijo);
             return false;
         }else{

             if (diferencia_cliente < diferencia_mayoria){
                 return false;
             }else{
                 return true;
             }
         }
      }
 );

//este validador indica si un campo es menor a otro indicado
$.validator.addMethod("fecha_camparar_menor",
     function(value, element, campo) {
         if (value == '') return true;

         if (verificarFecha(value) == false)
             return false;

         var campo_fec = $('#'+campo).val();
         if (verificarFecha(campo_fec) == false)
             return false;

         var diferencia_cliente = comparar_fechas(value, campo_fec);

         if (diferencia_cliente >= 0)
             return true;
         else
             return false;
      }
  );

//este validadora indica si un campo cumple con una expresion regular
//indicada como parametro.
$.validator.addMethod("regex",
    function(value, element, regexp) {
        var check = false;
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Por favor verificar el formato del campo."
);

//este validador indica si el valor ingresado es mayor al parametro
$.validator.addMethod("numero_mayor",
    function(value, element, valor) {
        var numero = parseInt(value);
        var result = false;

        if (numero > valor)
            result = true;

        return this.optional(element) || result;
    },
    "Por favor verificar que el numero sea mayor a cero."
);
