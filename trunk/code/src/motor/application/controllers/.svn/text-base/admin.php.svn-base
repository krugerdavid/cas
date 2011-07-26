<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Admin extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'admin';
    var $tipo_columna   = 'two_col_wide_right';

    var $mensaje_panel  = array();
    

	/** CONSTRUCTOR */
	function Admin()
    {
        parent::Controller();

        // cargar las librerias
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('myutils');
        $this->load->library('pagination');

        // cargar los asistentes
		$this->load->helper('form');
        $this->load->helper('array');

        // cargo los modelos
        $this->load->model('Usuario_model','usuario_modelo');
        $this->load->model('Comunidad_model', 'comunidad_modelo');
        $this->load->model('Confesion_model', 'confesion_modelo');
        $this->load->model('Rol_model', 'rol_modelo');
        $this->load->model('Relacion_model', 'relacion_modelo');

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

    /** Initializa el Controller */
	function index()
    {
        $data['lista_roles'] = $this->usuario_modelo->obtener_roles($this->config->item('items_x_resumen'));
        $data['lista_usuarios'] = $this->usuario_modelo->obtener_usuarios($this->config->item('items_x_resumen'),'');
        $data['lista_relaciones'] = $this->relacion_modelo->obt_todos($this->config->item('items_x_resumen'));

		// comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view('admin/panel',$data);
		$this->load->view('footer');
	}	

    /** Crea la pantalla para agregar usuario */
    function agregar_usuario()
    {
        $data['titulo_formulario'] = 'Agregar Usuario';
        $data['info_formulario'] = 'En esta secci&oacute;n se ingresaran los datos para un nuevo usuario del sistema. Rellene el formulario para poder completar la tarea.'.
                                    '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';

        // comprobar si el usuario esta logeado o no
        $this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view('admin/usuario_form',$data);
		$this->load->view('footer');
    }

    /**  Obtiene los datos del formulario y crea en la base de datos un nuevo usuario */
    function do_agregar_usuario()
    {
        $data = array();
        $tipo_mensaje;
        $mensaje;

        // obtengo del formulario los campos
        if (strtotime($this->input->post('usr_fecha_nac')) == TRUE){
            $fecha_nac = $this->input->post('usr_fecha_nac');
        }
        
        $nombre 	= ucwords($this->input->post('usr_nombres'));
		$apellido 	= ucwords($this->input->post('usr_apellidos'));
        $domicilio  = $this->input->post('usr_doc_num');
		$correo 	= $this->input->post('usr_email');
		$usuario 	= $this->input->post('usr_nombre_usuario');
        $pass   	= $this->input->post('usr_password');
        $pass_conf 	= $this->input->post('usr_password_confirm');
        $lugar_nac  = $this->input->post('usr_lugar_nac');
        $casado     = $this->input->post('usr_casado');
        $documento  = $this->input->post('usr_doc_num');
        $sexo       = $this->input->post('sexo');
        $rol        = $this->input->post('rol');
        $confesion 	= $this->input->post('cnf');
		$comunidad	= $this->input->post('cmn');

        if($pass == $pass_conf){
            $pass       = md5($pass);
            $agregar 	= $this->usuario_modelo->crear_usuario($nombre, $apellido, $correo, $usuario, $pass, $rol, $sexo, $documento,$fecha_nac, $lugar_nac, $casado, $comunidad, $confesion);
        }else{
            $agregar = 'pass_wrong';
        }

        switch($agregar){
			case $agregar['estado'] == "agregado": 
                $mensaje = 'Usuario creado exitosamente';
                $tipo_mensaje = 'request-accept';
                break;

            case 'existe':
                $mensaje = 'Usuario ya existe';
                $tipo_mensaje = 'request-error';
                break;

            case $agregar['estado'] == 'noagregado':
                $mensaje = 'Usuario No se ha creado';
                $tipo_mensaje = 'request-error';
                break;

            case 'vacio':
                $mensaje = 'El usuario no ha sido creado correctamente por falta de datos.';
                $tipo_mensaje = 'request-error';
                break;

            case 'pass_wrong':
                 $mensaje = 'La contrase&ntilde;a no coincide';
                $tipo_mensaje = 'request-error';
                break;
        }

        $data['mensaje'] = $mensaje;
        $data['tipo_mensaje'] = $tipo_mensaje;
        $data['hay_mensaje'] = 1;

        $this->session->set_flashdata($data);
        redirect(site_url("admin/agregar_usuario"));
    }

    /** Crea la pantalla para listar los usuarios */
    function listar_usuario()
    {

        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}


        $item_x_pagina = $this->config->item('items_x_pagina');

        // obtengo la lista de usuarios
        $data['lista_usuarios'] = $this->usuario_modelo->obtener_usuarios($item_x_pagina, $limite);

        // configuro el paginador
		$config['base_url']     = base_url().'admin/listar_usuario/';
		$config['total_rows']   = $this->usuario_modelo->total_usuarios();
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

        // comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view('admin/usuario_listar',$data);
		$this->load->view('footer');
    }

    /** Crea la pantalla para editar usuarios */
    function editar_usuario($id)
    {
        $data['info_usuario'] = $this->usuario_modelo->detalles_usuario($id);
        $data['editar_form'] = 1;
        $data['titulo_formulario'] = 'Editar Usuario';
        $data['info_formulario'] = 'En esta secci&oacute;n se podra modificar los datos para un usuario existente del sistema. Rellene el formulario para poder completar la tarea.'.
                                    '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';

        $this->info_modulo['tipo_columna']  = 'two_col_wide_right';

		// comprobar si el usuario esta logeado o no
		$this->load->view('header');
		$this->load->view('menu',$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view('admin/usuario_form',$data);
		$this->load->view('footer');
    }

    /** Edita los datos de un usuario obtenidos por el formulario */
    function do_editar_usuario()
    {
        $data = array();
        $tipo_mensaje;
        $mensaje;

        // obtengo del formulario los campos
        if (strtotime($this->input->post('usr_fecha_nac')) == TRUE){
            $fecha_nac = $this->input->post('usr_fecha_nac');
        }

        // obtengo del formulario los campos
        $nombre 	= ucwords($this->input->post('usr_nombres'));
		$apellido 	= ucwords($this->input->post('usr_apellidos'));
		$correo 	= $this->input->post('usr_email');
		$usuario 	= $this->input->post('usr_nombre_usuario');
        $pass_nuevo = $this->input->post('usr_password');
        $pass_conf 	= $this->input->post('usr_password_confirm');
        $sexo       = $this->input->post('sexo');
        $lugar_nac  = $this->input->post('usr_lugar_nac');
        $casado     = $this->input->post('usr_casado');
        $documento  = $this->input->post('usr_doc_num');
        $rol        = $this->input->post('rol');
        $confesion 	= $this->input->post('cnf');
		$comunidad	= $this->input->post('cmn');
        $pass       = $this->datos_usuario->usr_contrasena;

        if(!empty ($pass_nuevo)){
            if($this->datos_usuario->usr_contrasena != md5($pass_nuevo)){

                if(md5($pass_conf) == md5($pass_nuevo)){

                    //echo 'pass: '.$pass.' - '.md5($pass_nuevo);
                    $pass   = md5($pass_nuevo);

                }else{
                    $estado['mensaje-pass'] = 'pass-wrong';
                
                    //echo $estado['mensaje-pass'] ;
                }

            }else{
                $estado['mensaje-pass'] = 'pass-igual-actual';
                //echo $estado['mensaje-pass'] ;
            }
        }

        $usr_id = $this->input->post('usr_id');
        $prs_id = $this->input->post('prs_id');
        
        if(!empty($usr_id)){
            $estado = $this->usuario_modelo->editar_usuario($usr_id, $prs_id, $nombre, $apellido, $correo, $usuario, $pass, $rol, $sexo, $documento, $fecha_nac, $lugar_nac, $casado, $comunidad, $confesion);
        }

        switch($estado){
			case $estado['estado'] == "editado":
                $mensaje = 'Usuario editado exitosamente';
                $tipo_mensaje = 'request-accept';
                break;

            case $estado['estado'] == 'noeditado':
                $mensaje = 'Usuario No se ha editado';
                $tipo_mensaje = 'request-error';
                break;

            case 'vacio':
                $mensaje = 'El usuario no ha sido editado correctamente por falta de datos.';
                $tipo_mensaje = 'request-error';
                break;

            case $estado['mensaje-pass'] == 'pass-wrong':
                $mensaje = 'La contrase&ntilde;a no coincide';
                $tipo_mensaje = 'request-error';
                break;

            case $estado['mensaje-pass'] == 'pass-igual-actual':
                $mensaje = 'La contrase&ntilde;a es igual a la actual';
                $tipo_mensaje = 'request-error';
                break;

        }

        $data['mensaje'] = $mensaje;
        $data['tipo_mensaje'] = $tipo_mensaje;
        $data['hay_mensaje'] = 1;

        $this->session->set_flashdata($data);
        redirect(site_url("admin/listar_usuario"));

    }

    /** Elimina los datos de un usuario */
    function eliminar_usuario($id_usuario)
    {

        $query = $this->usuario_modelo->eliminar_usuario($id_usuario);
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

        $data['mensaje']        = $mensaje;
        $data['tipo_mensaje']   = $tipo_mensaje;
        $data['hay_mensaje']    = 1;

        $this->session->set_flashdata($data);
        redirect(site_url("admin/listar_usuario"));
        
    }

    /*-------------------------- ROL CONTROLLER ------------------------*/

	function rol()
	{
		$data['query'] = $this->rol_modelo->obt_todos();

		$this->_listar_rol($data);
	}

    function agregar_rol()
    {
        $data['query'] = $this->rol_modelo->obt_permisos();

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view("admin/rol_agregar", $data);
		$this->load->view("footer");
    }

    function insertar_rol()
    {
        $result = $this->rol_modelo->insertar();
        $this->_mostrar_mensaje_rol($result);
    }

    function editar_rol($id_rol)
    {
        if (!is_numeric($id_rol))
        {
            $mensaje = "Parametro incorrecto.FALSE";
            $this->_mostrar_mensaje_rol($mensaje);
        }
        $result = $this->rol_modelo->obt_rol_x_id($id_rol);
        if (!is_string($result))
        {
            $data['rol'] = $result;
            $listado = $this->rol_modelo->obt_permiso_x_rol($id_rol);
            $data['permisos'] = $listado;

            $this->load->view("header");
            $this->load->view("menu",$this->info_modulo);
            $this->load->view('admin/menu');
            $this->load->view("admin/rol_editar", $data);
            $this->load->view("footer");
        }
        else
        {
            $this->_mostrar_mensaje_rol($result);
        }
    }

    function guardar_rol()
    {
        $rol_id = $this->input->post('rol_codigo');
        if ($rol_id == NULL OR
            !is_numeric($this->input->post('rol_codigo')))
        {
            $this->_mostrar_mensaje_rol('No se encuentran parametros necesarios.FALSE');
        }

        $result = $this->rol_modelo->obt_rol_x_id($this->input->post('rol_codigo'));
        if (!is_string($result))
        {
            $result = $this->rol_modelo->modificar();
        }
        $this->_mostrar_mensaje_rol($result);
    }

    function eliminar_rol($rol_id)
    {
        if (!is_numeric($rol_id))
        {
            $this->_mostrar_mensaje_rol("Parametro incorrecto.FALSE");
        }

        $result = $this->rol_modelo->obt_rol_x_id($rol_id);
        if (!is_string($result))
        {
            $result = $this->rol_modelo->eliminar($rol_id);
        }
        $this->_mostrar_mensaje_rol($result);
    }

    function buscar_rol($palabra)
    {

        $result = $this->rol_modelo->buscar($palabra);
        if (!is_string($result))
        {
            $data['query'] = $result;
            $this->_listar_rol($data);
            return;
        }
        $this->_mostrar_mensaje_rol($result);
    }

    function _listar_rol($data)
	{
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view("admin/rol_listado", $data);
		$this->load->view("footer");
	}

    function _mostrar_mensaje_rol($result)
    {
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

        redirect(site_url("admin/rol/"));
    }

    /*-------------------------- TIPO DE RELACION CONTROLLER ------------------------*/
	function relacion()
	{
		$data['query'] = $this->relacion_modelo->obt_todos(100);

		$this->_listar_relacion($data);
	}

	function editar_relacion()
	{
		$this->mensaje = $this->relacion_modelo->modificar();
		redirect(site_url("admin/relacion/"));
	}

	function eliminar_relacion($id)
	{
		$query = $this->relacion_modelo->eliminar($id);
		redirect(site_url("admin/relacion/"));
	}

	function insertar_relacion()
	{
		$result = $this->relacion_modelo->insertar();

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

        redirect(site_url("admin/relacion/"));
    }

	function buscar_relacion()
	{
		$data['query'] = $this->relacion_modelo->buscar();
		$this->_listar_relacion($data);
	}

    function agregar_relacion()
    {
        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view("admin/relacion_agregar");
		$this->load->view("footer");
    }

	function _listar_relacion($data)
	{
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view('admin/menu');
		$this->load->view("admin/relacion_listado", $data);
		$this->load->view("footer");
	}
    
}

/* End of admin.php */
/* Location: ./motor/controllers/admin.php */
?>
