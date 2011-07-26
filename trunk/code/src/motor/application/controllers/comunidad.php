<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Comunidad extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'comunity';
    var $tipo_columna   = 'two_col_wide_right';

	/** CONSTRUCTOR */
	function Comunidad(){

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
        redirect(site_url("comunidad/listar_comunidades/"));
		//$this->_mostrar($data);
	}	
	
	function editar()
	{
		$this->mensaje = $this->Comunidad_model->modificar();
		redirect(site_url("comunidad/listar_comunidades/"));
	}

    function modificar($com_id)
    {
        $result = $this->Comunidad_model->obt_x_id($com_id);
        
        $data['titulo_formulario'] = 'Agregar Comunidad';
        $data['info_formulario'] = 'En esta secci&oacute;n se podr&aacute; agregar los datos de una nueva comunidad del sistema. Rellene el formulario para poder completar la tarea.';

        $data['query'] = $result;
        $data['editar_form'] = 1;

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('comunidad/menu');
		$this->load->view("comunidad/agregar", $data);
		$this->load->view("footer");

    }

    function verificar_comunidad()
    {
        if ($this->input->post('com_nombre')== NULL)
        {
           echo "FALSE";
           return;
        }
        $com_nombre = $this->input->post('com_nombre');
        $dpto = $this->input->post('dto_id');
        $com_id = $this->input->post('com_codigo');

        if ($this->Comunidad_model->comunidad_existe($com_nombre, $dpto, $com_id) == true){
            echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

    function guardar()
    {
        if ($this->input->post('com_nombre')== NULL)
        {
           $this->_mostrar_mensaje("Parametros incorrectos.FALSE");
        }
        $mensaje = '';
        if ($this->input->post('com_codigo')== NULL ||
            $this->input->post('com_codigo')== '')
        {
            $mensaje = $this->insertar();
        }else
        {
            $mensaje = $this->editar();
        }
        
        $this->_mostrar_mensaje($mensaje);
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
        $msg = array( 'mensaje'  => $mensaje, 'tipo_mensaje' => $tipo_mensaje, 'hay_mensaje' => 1 );
        $this->session->set_flashdata($msg);

        redirect(site_url("comunidad/listar_comunidades"));
	}

    function _mostrar_mensaje($query)
    {
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
        $msg = array( 'mensaje'  => $mensaje, 'tipo_mensaje' => $tipo_mensaje, 'hay_mensaje' => 1 );
        $this->session->set_flashdata($msg);

        redirect(site_url("comunidad/listar_comunidades"));
    }
	
	function insertar()
	{
		$result = $this->Comunidad_model->insertar();        
        $result = explode('.', $result);
        $mensaje = $result[0];
        if($result[1] == "TRUE"):
            $tipo_mensaje = 'request-accept';
        else:
            $tipo_mensaje = 'request-error';
        endif;
        $msg = array(
            'mensaje'  => $mensaje,
            'tipo_mensaje' => $tipo_mensaje,
            'hay_mensaje' => 1            
        );
        $this->session->set_flashdata($msg);
        redirect(site_url("comunidad/agregar"));
    }
	
	function buscar($palabra)
	{

        $word = $palabra;

        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('items_x_pagina');

        // obtengo la lista de usuarios
        $data['query'] = $this->Comunidad_model->buscar($word);
        

        $this->_crear_paginacion();

        // agrego la paginacion a la vista
        $data['paginacion']     = $this->pagination->create_links();
        $data['titulo_formulario'] = 'Listar Comunidades';
        $data['info_formulario'] = 'En esta sección podr&aacute; editar o eliminar los datos de una comunidad en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea.';

        // comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('comunidad/menu');
		$this->load->view("comunidad/panel", $data);
		$this->load->view('footer');
        
	}

    function agregar()
    {
        $data['titulo_formulario'] = 'Agregar Comunidad';
        $data['info_formulario'] = 'En esta secci&oacute;n se podr&aacute; agregar los datos de una nueva comunidad del sistema. Rellene el formulario para poder completar la tarea.';
        $data['editar_form'] = 0;

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('comunidad/menu');
		$this->load->view("comunidad/agregar", $data);
		$this->load->view("footer");
    }

    /** Crea la pantalla para listar las comunidades */
    function listar_comunidades()
    {

        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        // seteo el campo a cual ordenar
        if($this->input->post('com_sort') != ''){
            $order_by = array( 'order_cmn' => $this->input->post('com_sort').'.'.$this->input->post('com_sort_dir'));
			$this->session->set_userdata($order_by);
        }

        $item_x_pagina = $this->config->item('items_x_pagina');

        // obtengo la lista de usuarios
        $data['query'] = $this->Comunidad_model->obtener_comunidades($item_x_pagina, $limite, $this->session->userdata('order_cmn'));

        $this->_crear_paginacion();

        // agrego la paginacion a la vista
        $data['paginacion']         = $this->pagination->create_links();
        $data['titulo_formulario']  = 'Listar Comunidades';
        $data['info_formulario']    = 'En esta sección podr&aacute; editar o eliminar los datos de una comunidad en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea.';

        // comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('comunidad/menu');
		$this->load->view("comunidad/panel", $data);
		$this->load->view('footer');
    }

    function _crear_paginacion()
    {

     // configuro el paginador
		$config['base_url']     = base_url().'comunidad/listar_comunidades/';
		$config['total_rows']   = $this->Comunidad_model->total_comunidades();
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
/* Location: ./motor/controllers/comunidad.php */
?>