<?php

class Confesion extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'confetion';
    var $tipo_columna   = 'two_col_wide_right';

	/** CONSTRUCTOR */
	function Confesion(){

		parent::Controller();

        $this->load->library('session');
        $this->load->library('myutils');
        $this->load->library('pagination');

		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->database();


		$this->load->model('Confesion_model');
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
		$data['query'] = $this->Confesion_model->obt_todos();

		$this->_mostrar($data);
        redirect(site_url("confesion/listar_confesiones/"));
	}

	function editar()
	{
		$this->mensaje = $this->Confesion_model->modificar();
		redirect(site_url("confesion/"));
	}

	function eliminar($id)
	{
		$query = $this->Confesion_model->eliminar($id);
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

        redirect(site_url("confesion/"));
	}

	function insertar()
	{
		$result = $this->Confesion_model->insertar();

        $result = explode('.', $result);
        $mensaje = $result[0];

        if($result[1] == "TRUE"):
            $tipo_mensaje = 'request-accept';
        else:
            $tipo_mensaje = 'request-error';
        endif;


        $data = array(
            'mensaje'  => $mensaje,
            'tipo_mensaje' => $tipo_mensaje,
            'hay_mensaje' => 1
        );

        $this->session->set_flashdata($data);

        redirect(site_url("confesion/"));
	}

	function buscar($palabra)
	{

        $word = $palabra;
        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('items_x_pagina');

        
        $data['query'] = $this->Confesion_model->buscar($word);
        

        $this->_crear_paginacion();

        // agrego la paginacion a la vista
        $data['paginacion']     = $this->pagination->create_links();
        $data['titulo_formulario'] = 'Listar Confesiones';
        $data['info_formulario'] = 'En esta sección podr&aacute; editar o eliminar los datos de una confesion en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea.';

        // comprobar si el usuario esta logeado o no
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('confesion/menu');
		$this->load->view("confesion/panel", $data);
		$this->load->view('footer');

	}

    function agregar()
    {
        $data['titulo_formulario'] = 'Agregar Confesion';
        $data['info_formulario'] = 'En esta secci&oacute;n se podr&aacute; agregar los datos de una nueva confesion del sistema. Rellene el formulario para poder completar la tarea.';

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('confesion/menu');
		$this->load->view("confesion/agregar", $data);
		$this->load->view("footer");
    }

     function verificar_confesion()
    {
        if ($this->input->post('con_nombre')== NULL)
        {
           echo "FALSE";
           return;
        }
        $con_nombre = $this->input->post('con_nombre');
        $con_id = $this->input->post('con_codigo');

        if ($this->Confesion_model->confesion_existe($con_nombre, $con_id) == true){
            echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

    function listar_confesiones()
    {

        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('items_x_pagina');

        // seteo el campo a cual ordenar
        if($this->input->post('cnf_sort') != ''){
            $order_by = array( 'order_cnf' => $this->input->post('cnf_sort').'.'.$this->input->post('cnf_sort_dir'));
			$this->session->set_userdata($order_by);
        }

        // obtengo la lista de usuarios
        $data['query'] = $this->Confesion_model->obtener_confesiones($item_x_pagina, $limite, $this->session->userdata('order_cnf'));

        $this->_crear_paginacion();

        // agrego la paginacion a la vista
        $data['paginacion']     = $this->pagination->create_links();
        $data['titulo_formulario'] = 'Listar Confesiones';
        $data['info_formulario'] = 'En esta sección podr&aacute; editar o eliminar los datos de una confesion en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea.';

        // comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('confesion/menu');
		$this->load->view("confesion/panel", $data);
		$this->load->view('footer');
    }
    
    function _crear_paginacion()
    {

     // configuro el paginador
		$config['base_url']     = base_url().'confesion/listar_confesiones/';
		$config['total_rows']   = $this->Confesion_model->total_confesiones();
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
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
		$this->load->view("confesion/panel", $data);
		$this->load->view("footer");
	}
}

/* End of confesion.php */
/* Location: ./motor/controllers/confesion.php */
?>