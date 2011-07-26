<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Home extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'home';
    var $tipo_columna   = 'two_col_wide_left';
    var $login_mensaje  = '';

    //$this->menu_info[$column_type];

	/** CONSTRUCTOR */
	function Home()
    {

		parent::Controller();

        // cargar las librerias
        $this->load->library('form_validation');
        $this->load->library('session');

        $prefs = array (
               'local_time'    => time()
             );

        $this->load->library('calendar', $prefs);

        // cargar los asistentes
        $this->load->helper('url');
		$this->load->helper('form');

        // setear la informacion sobre el modulo
        $this->info_modulo['titulo_modulo'] = $this->titulo_modulo;
		$this->info_modulo['tipo_columna']  = $this->tipo_columna;

        $this->load->model('Comunidad_model', 'comunidad_modelo');
        $this->load->model('Confesion_model', 'confesion_modelo');
        $this->load->model('Miembro_model', 'miembro_modelo');
        
        // carga el modelo de usuario y obtengo los datos de este usuario
        $this->load->model('Usuario_model','usuario_modelo');
		$this->datos_usuario = $this->usuario_modelo->detalles_usuario($this->session->userdata('user_id'));
	}

	/** Initialize the Controller */
	function index()
    {

		// comprobar si el usuario esta logeado o no
        if(empty($this->session->userdata['is_logged_in'])){
			header("Location: ".base_url()."login/");
		}

        $data['lista_miembros'] = $this->miembro_modelo->obtener_miembros($this->config->item('miembros_x_resumen'),'');

        $data['lista_comunidades'] = $this->comunidad_modelo->obtener_comunidades($this->config->item('items_x_resumen'),'');
        $data['lista_confesiones'] = $this->confesion_modelo->obtener_confesiones($this->config->item('items_x_resumen'),'');


		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
		$this->load->view('leftColumn',$data);
		$this->load->view('rightColumn');
		$this->load->view('footer');

	}

	/** Load the Login view */
	function login()
    {
		$this->load->view('login');
	}

	/** Login the username */
	function do_login()
    {

        $username   = trim($this->input->post('log_username',TRUE));
        $password   = trim($this->input->post('log_password',TRUE));
        $dologin    = trim($this->input->post('log_dologin',TRUE));

        // encripto la contrasena
        $pass   = md5($password);

        $ahora = date($this->config->item('formato_fecha'));

        $row = $this->usuario_modelo->obtener_usuario($username, $pass);

		if(!empty($row)){
			$data = array(
                        'user_id' => $row->usr_id,
                        'persona_id' => $row->prs_id,
                        'rol_id' => $row->rol_id,
                        'is_logged_in' => 1
            );

			$this->session->set_userdata($data);

            $this->usuario_modelo->actualizar_ultima_visita($ahora,$row->usr_id);
            //$query = $this->db->query("UPDATE usuarios SET ultima_visita='".$ahora."',ultima_ip_acceso='".$direccion_ip."',ultimo_user_agent='".$user_agent."' WHERE id='".$row->id."'");
			header("Location: ".base_url());
		}else{

            $this->info_modulo['tipo_mensaje'] = 'request-error';
            $this->info_modulo['message'] = 'Usuario o contrase&ntilde;a incorrectas';
            $this->load->view('login',$this->info_modulo);
            //header("Location: ".base_url());
		}

	}

	/** Logout the current username */
	function logout()
    {
		$this->session->sess_destroy();

        $this->info_modulo['tipo_mensaje'] = 'request-accept';
        $this->info_modulo['message'] = 'Ha salido correctamente';
        $this->load->view('login',$this->info_modulo);

		//header("Location: ".base_url());
	}

    function restringido()
    {
		$data['acceso_denegado']    = '1';
        $data['mensaje']        = 'No tiene permiso para acceder a esa &aacute;rea. Ha sido redirigido/a al inicio.';
        $data['tipo_mensaje']   = 'request-error';

        $this->session->set_flashdata($data);

        //$this->load->view('mensaje',$data);
        header("Location: ".base_url());
    }

}

/* End of home.php */
/* Location: ./motor/controllers/home.php */
?>