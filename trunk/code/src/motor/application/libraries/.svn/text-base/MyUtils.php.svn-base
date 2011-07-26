<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of MyUtils
 *
 * @author David Kruger
 */
class MyUtils {

    private $CI;
    private $error;
    private $mensaje;
    var $data = array();

    function MyUtils()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->CI->load->model('Usuario_model','usuario_modelo');
        
    }

    /*
     * Comprueba si hubo errores en el query y si hubo,
     * retorna el numero del error y el mensaje 
     */
    function existe_error()
    {
        // comprobar si no hubo errores en la base de datos
        if ($this->CI->db->_error_message()){

            $this->mensaje = $this->CI->db->_error_message();
            $this->error = $this->CI->db->_error_number();

            switch($this->error)
            {
                case 1451 :
                    $this->mensaje = 'No se puede eliminar este item ya que se esta usando en otras secciones';
                    break;

                
            }
            $this->data['error']        = $this->error;
            $this->data['mensaje']      = $this->mensaje;
            $this->data['tipo_mensaje'] = 'request-error';
        }

        return $this->data;

    }

    /*
     * Construye el menu de acuerdo al rol del usuario
     */
    function construir_menu($rol_id){

        $modulos = $this->CI->usuario_modelo->obtener_modulos_usuario($rol_id);
        foreach($modulos as $modulo){

            echo '<li><a href=#/>'.$modulo->prm_modulo.'</a>';
            $permisos = $this->CI->usuario_modelo->obtener_permisos_usuario($rol_id, $modulo->prm_modulo);

            if(!empty($permisos)){
                echo '<ul>';
                    foreach($permisos as $permiso){
                        echo '<li><a href='.base_url().$permiso->prm_controller.'/'.$permiso->prm_controller_funcion.'>'.$permiso->prm_nombre.'</a></li>';
                    }
                echo '</ul>';
            }
            echo '</li>';

        }
    }

    /* 
     * Retorna la diferencia en dias de dos fechas.
     * Resta la primera de la segunda.
     */
    function diferencia_fechas($fecha1, $fecha2)
    {
        if (strtotime($fecha1) == FALSE && strtotime($fecha1) == FALSE)
        {
            return "Error de parametros.FALSE";
        }

        $fecha_uno = strtotime($fecha1);
        $fecha_dos = strtotime($fecha2);

        $result = ($fecha_uno - $fecha_dos) / (60*60*24);

        $result = floor($result);

        return $result;
    }

    /*
     * Retorna si una fecha es mayor de edad. Compara
     * con la configuracion de la aplicacion para mayoria de edad.
     */
    function mayor_de_edad($fecha3)
    {
        if (strtotime($fecha3) == FALSE)
        {
            return FALSE;
        }

        $fecha2 = date("Y-m-d");
        $fecha1 = date("Y-m-d",strtotime("-20 years"));

        $cantidad_mayor = abs($this->diferencia_fechas($fecha1, $fecha2));

        $diferencia = $this->diferencia_fechas($fecha3, $fecha2);

        if ($diferencia >=0)
        {
            return FALSE;
        }

        $diferencia = abs($diferencia);

        if ($diferencia >= $cantidad_mayor)
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }

}
?>
