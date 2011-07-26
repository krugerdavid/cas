<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Aporte extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'aports';
    var $tipo_columna   = 'two_col_wide_right';

	/** CONSTRUCTOR */
	function Aporte(){

		parent::Controller();

        $this->load->library('session');
        $this->load->library('myutils');
        $this->load->library('pagination');

		$this->load->helper('html');
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->database();

        // cargo los modelos
		$this->load->model('Comunidad_model');
        $this->load->model('Usuario_model','usuario_modelo');
        $this->load->model('Miembro_model','miembro_modelo');

        // se declara la informacion sobre el modulo
        $this->info_modulo['titulo_modulo'] = $this->titulo_modulo;
		$this->info_modulo['tipo_columna']  = $this->tipo_columna;

        // compruebo de que el usuario este logeado para acceder a este modulo
        if(empty($this->session->userdata['is_logged_in'])){
			header("Location: ".base_url()."login/");
		}

        // obtengo los datos del usuario logeado.
		$this->datos_usuario = $this->usuario_modelo->detalles_usuario($this->session->userdata('user_id'));

        if(!$this->usuario_modelo->esta_habilitado($this->datos_usuario->rol_id,$this->uri->segment(1))){
            redirect(base_url()."restringido/");
		}


	}

	/** Initialize the Controller */
	function index()
	{
        redirect(site_url("aporte/listar_aporte/"));
		//$this->_mostrar($data);
	}

	function editar($aporte_id)
	{
		$aporte_datos = $this->miembro_modelo->obt_aporte_x_id($aporte_id);
        $persona_datos = $this->miembro_modelo->obt_persona_x_id($aporte_datos->mmb_id);
        $data['query'] = $aporte_datos;
        $data['nombre_persona'] = $persona_datos->prs_nombres." ".$persona_datos->prs_apellidos;

        $data['titulo_formulario'] = 'Editar Aporte';
        $data['info_formulario'] = 'En esta secci&oacute;n se podr&aacute; registrar los aportes de los miembros en el sistema. Rellene el formulario para poder completar la tarea.';
        $data['editar_form'] = 1;

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('aporte/menu');
		$this->load->view("aporte/agregar", $data);
		$this->load->view("footer");
	}

    function miembro_nombre($variable){

        if (empty($variable)){
            return;
        }

        $results = $this->miembro_modelo->buscar_miembro_aporte($variable, 10, 0);

        foreach ($results as $row)
        {
            echo $row->prs_nombres." ".$row->prs_apellidos."|".$row->prs_doc_num."|".$row->prs_id."\n";
        }
    }

    function buscar_nombre(){
        if ($this->input->post('text_buscar') ==  NULL)
        {
            echo "isEmpty";
            return ;
        }

        $variable = $this->input->post('text_buscar');
        $results = $this->miembro_modelo->buscar_miembro_aporte($variable, 10, 0);
        $data['results'] = $results;

        $this->load->view('aporte/resultados', $data);

    }

	function eliminar($id)
	{
        $query = $this->Comunidad_model->eliminar($id);
        $result = explode('.', $query);
        $mensaje = $result[0];

        // compruebo el tipo de mensaje obtenido
        if($result[1] == "TRUE"):
            $tipo_mensaje = 'request-accept';
        else:
            $tipo_mensaje = 'request-error';
        endif;

        // comprobar si hubo errores en la base de datos
        $error = $this->myutils->existe_error();
        if ($error)
        {
            $mensaje = $error['mensaje'];
            $tipo_mensaje = $error['tipo_mensaje'];
        }

        // seteo el mensaje de la accion reciente
        $data = array( 'mensaje'  => $mensaje, 'tipo_mensaje' => $tipo_mensaje, 'hay_mensaje' => 1 );
        $this->session->set_flashdata($data);

        redirect(site_url("aporte/"));
	}

    function _mostrar_mensaje($mostrar_ver)
    {
        $result = explode('.', $mostrar_ver);
        $mensaje = $result[0];

        // compruebo el tipo de mensaje obtenido
        if($result[1] == "TRUE"):
            $tipo_mensaje = 'request-accept';
        else:
            $tipo_mensaje = 'request-error';
        endif;

        // comprobar si hubo errores en la base de datos
        $error = $this->myutils->existe_error();
        if ($error)
        {
            $mensaje = $error['mensaje'];
            $tipo_mensaje = $error['tipo_mensaje'];
        }

        // seteo el mensaje de la accion reciente
        $msg = array( 'mensaje'  => $mensaje, 'tipo_mensaje' => $tipo_mensaje, 'hay_mensaje' => 1 );
        $this->session->set_flashdata($msg);

        redirect(site_url("aporte/"));
    }

    function _verificar_variable_post($nombre)
    {
        if ($this->input->post($nombre) == NULL)
            return false;

        if ($this->input->post($nombre) == '')
            return false;

        return true;
    }

    function guardar()
    {
        if ($this->_verificar_variable_post('miembro_id') == FALSE)
        {
            $this->_mostrar_mensaje("Parametros incorrectos.FALSE");
        }
        if (!$this->_verificar_variable_post('miembro_id') ||
            !$this->_verificar_variable_post('miembro_nombre') ||
            !$this->_verificar_variable_post('aporte_monto') ||
            !$this->_verificar_variable_post('aporte_fecha_server'))
        {
            $this->_mostrar_mensaje("Parametros incorrectos.FALSE");
        }
        if (strtotime($this->input->post('aporte_fecha_server')) == FALSE){
            $this->_mostrar_mensaje("Parametros incorrectos.FALSE");
        }
        //verificar si miembro id es de miembro.

        $datos = array();
        $datos['mmb_id'] = $this->input->post('miembro_id');
        $datos['apr_monto'] = $this->input->post('aporte_monto');
        $datos['apr_fecha'] = $this->input->post('aporte_fecha_server');
        $salida = '';

        if ($this->input->post("aporte_id") == '')
        {
            $salida = $this->miembro_modelo->insertar_aporte($datos);
        }
        else    
        {
            $salida = $this->miembro_modelo->modificar_aporte($this->input->post('aporte_id'), $datos);
        }
        $this->_mostrar_mensaje($salida);
    }

    function agregar()
    {
        $data['titulo_formulario'] = 'Agregar Aporte';
        $data['info_formulario'] = 'En esta secci&oacute;n se podr&aacute; registrar los aportes de los miembros en el sistema. Rellene el formulario para poder completar la tarea.';
        $data['editar_form'] = 0;

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('aporte/menu');
		$this->load->view("aporte/agregar", $data);
		$this->load->view("footer");
    }

    /** Crea la pantalla para listar las comunidades */
    function listar_aporte()
    {

        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('items_x_pagina');

        // seteo el campo a cual ordenar
        if($this->input->post('apr_sort') != ''){
            $order_by = array( 'order_apr' => $this->input->post('apr_sort').'.'.$this->input->post('apr_sort_dir'));
			$this->session->set_userdata($order_by);
        }

        // obtengo la lista de usuarios
        $data['query'] = $this->miembro_modelo->obtener_aportes($item_x_pagina, $limite, $this->session->userdata('order_apr'));

        $this->_crear_paginacion();

        // agrego la paginacion a la vista
        $data['paginacion']     = $this->pagination->create_links();
        $data['titulo_formulario'] = 'Listar Aportes';
        $data['info_formulario'] = 'En esta sección podr&aacute; editar los datos de un aporte en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea.';

        // comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('aporte/menu');
		$this->load->view("aporte/panel", $data);
		$this->load->view('footer');
    }

    function _crear_paginacion()
    {

     // configuro el paginador
		$config['base_url']     = base_url().'aporte/listar_aporte/';
		$config['total_rows']   = $this->miembro_modelo->total_aportes();
		$config['per_page']     = $this->config->item('items_x_pagina');

        $config['num_links'] = 5;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class=active>';
        $config['cur_tag_close'] = '</li>';

        $config['first_link'] = 'Inicio';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class=previous>';
        $config['prev_tag_close'] = '</li>';

        $config['last_link'] = 'Ultimo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class=next>';
        $config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

    }
	function _mostrar($data)
	{
        $data['titulo_formulario'] = 'Listar Comunidades';
        $data['info_formulario'] = 'En esta sección podr&aacute; editar o eliminar los datos de una comunidad en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea.';

		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('comunidad/menu');
		$this->load->view("comunidad/panel", $data);
		$this->load->view("footer");
	}
}

/* End of comunidad.php */
/* Location: ./motor/controllers/aporte.php */
?>