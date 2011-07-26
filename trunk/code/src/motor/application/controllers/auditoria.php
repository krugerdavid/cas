<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Auditoria extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'audit';
    var $tipo_columna   = 'two_col_wide_right';

	/** CONSTRUCTOR */
	function Auditoria(){

		parent::Controller();

        $this->load->library('session');
        $this->load->library('pagination');
        
		$this->load->helper('html');
		$this->load->helper('url');		
		$this->load->database();

        // cargo los modelos
		$this->load->model('Auditoria_model');
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
		$data['query'] = $this->Auditoria_model->obt_todos();
		
		$this->_mostrar($data);
	}	
		
	function buscar()
	{
		$data['query'] = $this->Auditoria_model->buscar();
        $this->listar_logs($data);
	}
	
	function listar_logs()
	{
        // seteo el limite
        $limite = $this->uri->segment(3);


		if(empty($limite)){$limite = 0;}


        $item_x_pagina = $this->config->item('items_x_pagina');

        // seteo el campo a cual ordenar
        if($this->input->post('aud_sort') != ''){
            $order_by = array( 'order_aud' => $this->input->post('aud_sort').'.'.$this->input->post('aud_sort_dir'));
			$this->session->set_userdata($order_by);
        }

        // obtengo la lista de usuarios
        $data['query'] = $this->Auditoria_model->obtener_logs($item_x_pagina, $limite,$this->session->userdata('order_aud'));

        // configuro el paginador
		$config['base_url']     = base_url().'auditoria/listar_logs/';
        $config['total_rows']   = $this->Auditoria_model->total_logs();
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

        // agrego la paginacion a la vista
        $data['paginacion']     = $this->pagination->create_links();

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
		$this->load->view("auditoria/panel", $data);
		$this->load->view("footer");
	}
}

/* End of auditoria.php */
/* Location: ./motor/controllers/auditoria.php */
?>