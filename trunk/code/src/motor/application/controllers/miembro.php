<?php

class Miembro extends Controller {

    var $info_modulo    = array();
    var $titulo_modulo  = 'miembro';
    var $tipo_columna   = 'two_col_wide_right';

	/** CONSTRUCTOR */
	function Miembro(){

		parent::Controller();

        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('MyUtils', 'myutils');

		$this->load->helper('html');
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('array');
		$this->load->database();

		$this->load->model('Miembro_model', 'miembro_modelo');
        $this->load->model('Usuario_model','usuario_modelo');
        $this->load->model('Confesion_model', 'confesion_modelo');
        $this->load->model('Comunidad_model', 'comunidad_modelo');
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

	/* -------------------------------  MIEMBRO  ------------------------------ */
	function index()
	{
		redirect(base_url()."miembro/listar_miembro");
	}

    function listar_miembro()
    {
        // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('miembros_x_pagina');

        // seteo el campo a cual ordenar
        if($this->input->post('mmb_sort') != ''){
            $order_by = array( 'order_mmb' => $this->input->post('mmb_sort').'.'.$this->input->post('mmb_sort_dir'));
			$this->session->set_userdata($order_by);
        }

        // obtengo la lista de usuarios
        $data['query'] = $this->miembro_modelo->obtener_miembros($item_x_pagina, $limite, $this->session->userdata('order_mmb'));
        $data['titulo_list'] = 'Listado de Miembros';
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; editar o deshabilitar los datos de un nuevo miembro a la base de datos. Escoje una opción para poder continuar con la tarea.';
        $menu_data['mostrar_integrantes'] = 'FALSE';

        //genero la paginacion de los resultados
        $data['paginacion']     = $this->_crear_paginacion(base_url().'miembro/listar_miembro/',
            $this->miembro_modelo->cantidad_miembros(), $this->config->item('miembros_x_pagina'));

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/miembro_listado", $data);
		$this->load->view("footer");
    }

	function guardar()
	{
        if ($this->input->post('usr_nombres') ==  NULL)
        {
            $this->_mostrar_mensaje_miembro("Parametros incorrectos.FALSE", "miembro/listar_miembro/");
        }
        //obtener los datos de la persona del formulario recibido
        $datos = $this->_obtener_datos_persona();

        $mensaje = '';
        $miembro_id = $this->input->post('miembro_id');

        //si se ha asignado un miembro id es porque se va a editar
        //los datos del miembro
        if (empty($miembro_id))
        {
            $datos['prs_estado'] = 'A';
            $mensaje = $this->miembro_modelo->insertar($datos);
        }else
        {
            $mensaje = $this->miembro_modelo->modificar($miembro_id, $datos);
        }

        $this->_mostrar_mensaje_miembro($mensaje, "miembro/listar_miembro/");
	}

    function editar($id)
	{
        if (empty($id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }
        
        if($this->miembro_modelo->verificar_miembro_existe($id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Miembro no existe, favor verificar.FALSE", "miembro/listar_miembro/");
        }

        $result = $this->miembro_modelo->obt_x_id($id);
		$data['query'] = $result;
        $data['editar_form'] = 1;
        $titulo = 'Editar miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;

        //verificar que si se obtuvo los datos del miembro sino
        //devuelve un mensaje que se debe mostrar en la pagina listado
        if (!is_string($data['query']))
        {
            $menu_data['mostrar_integrantes'] = 'TRUE';
            $menu_data['miembro_id'] = $id;
            $data['titulo_form'] = $titulo;
            $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; editar los datos de un nuevo miembro a la base de datos. Rellene el formulario para poder completar la tarea.'.
                                        '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';


            $this->load->view("header");
            $this->load->view("menu",$this->info_modulo);
            $this->load->view("miembro/miembro_menu", $menu_data);
            $this->load->view("miembro/miembro_agregar", $data);
            $this->load->view("footer");
        }
        else //mostrar mensaje de error
        {
            $this->_mostrar_mensaje_miembro($data['query'], "miembro/listar_miembro/");
        }
	}

    function agregar()
	{
        $data['editar_form'] = 0;
        $data['titulo_form'] = 'Agregar nuevo miembro';
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; agregar los datos de un nuevo miembro a la base de datos. Rellene el formulario para poder completar la tarea.<br /><br />'.
                                    'Los campos marcados con (*) asterisco son obligatorios.';

        $menu_data['mostrar_integrantes'] = 'FALSE';
        $this->load->view("header");
        $this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
        $this->load->view("miembro/miembro_agregar", $data);
        $this->load->view("footer");
	}

    function buscar($mensaje)
    {
        if (empty($mensaje))
		{
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }
        if($mensaje == '')
        {
            redirect(site_url("miembro/"));
        }

        // seteo el limite
        $limite = $this->uri->segment(4);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('miembros_x_pagina');

        $resultss = $this->miembro_modelo->buscar_en_lista($mensaje, $item_x_pagina, $limite);

        // obtengo la lista de usuarios
        $data['query'] =  $resultss['data'];
        $data['titulo_list'] = 'Listado de Miembros';
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; editar o deshabilitar los datos de un nuevo miembro a la base de datos. Escoje una opción para poder continuar con la tarea.';

        $data['paginacion']     = $this->_crear_paginacion(base_url().'miembro/buscar/'.$mensaje.'/',
        $resultss['cantidad'], $this->config->item('miembros_x_pagina'));

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
		$this->load->view("miembro/miembro_listado", $data);
		$this->load->view("footer");
    }

    function cambiar_estado_miembro($miembro_id)
    {
        if (empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Miembro no existe, favor verificar.FALSE", "miembro/listar_miembro/");
        }

        $this->miembro_modelo->cambiar_estado_persona($miembro_id);
        $this->_mostrar_mensaje_miembro("Se ha modificado el miembro con exito.TRUE", "miembro/listar_miembro/");

    }

    function verificar_documento(){
        if ($this->input->post('documento_numero') == NULL){
            echo "FALSE";
            return;
        }

        $docnum = $this->input->post('documento_numero');
        $miembro_id = $this->input->post('miembro_id');
        if ($this->miembro_modelo->documento_numero_existe($docnum, $miembro_id) == true){
            echo "TRUE";
        }else{
            echo "FALSE";
        }
    }

    /* -------------------------------  FIN MIEMBRO  ------------------------------ */



    /* -------------------------------  HIJO  ------------------------------ */
    function hijo_a_miembro($miembro_id, $hijo_id)
    {
        if(empty($miembro_id) || empty($hijo_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_hijo_miembro($miembro_id, $hijo_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro e hijo no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }


        if($this->miembro_modelo->verificar_miembro_existe($hijo_id)=='TRUE')
        {
            $this->_mostrar_mensaje_miembro("Hijo ya es miembro.FALSE", "miembro/listar_miembro/");
        }

        $dato_hijo = $this->miembro_modelo->obt_persona_x_id($hijo_id);
        $fecha_nac = date("Y-m-d", strtotime($dato_hijo->prs_fecha_nacimiento));
		if ($this->myutils->mayor_de_edad($fecha_nac) == FALSE){
            $this->_mostrar_mensaje_miembro("Hijo no es mayor de edad, verificar.FALSE", "miembro/listar_miembro/");
        }

        if ($this->miembro_modelo->persona_a_miembro($hijo_id)=='TRUE')
        {
            $this->_mostrar_mensaje_miembro("El hijo a sido asignado como miembro.TRUE", "miembro/listar_miembro/");
        }else
        {
            $this->_mostrar_mensaje_miembro("El hijo no ha sido asignado como miembro.FALSE", "miembro/listar_miembro/");
        }
    }

    function hijo_guardar()
    {
        $datos = $this->_obtener_datos_persona();

        $mensaje = '';
        $miembro_id = $this->input->post('miembro_id');
        $otro_id = '';
        $otro_id = $this->input->post('hijo_id');

        if (empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        //si se ha asignado un hijo id es porque se va a editar
        //los datos del hijo
        if (empty($otro_id))
        {
            $mensaje = $this->miembro_modelo->insertar_hijo($miembro_id, $datos);
        }else
        {
            $mensaje = $this->miembro_modelo->modificar_hijo($miembro_id, $otro_id, $datos);
        }

        $this->_mostrar_mensaje_miembro($mensaje, "miembro/hijo_listar/".$miembro_id."/");
    }

    function hijo_agregar($miembro_id)
    {
        if(empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Miembro no existe, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        //traigo los datos del miembro para colocar en la cabecera
        $result = $this->miembro_modelo->obt_x_id($miembro_id);
        $titulo = 'Agregar hijo a miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
        $data['titulo_form'] = $titulo;
        $data['miembro_fecha_nac'] = $result->prs_fecha_nacimiento;
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; agregar los datos de un hijo de un miembro en la base de datos. Rellene el formulario para poder continuar con la tarea. <br /><br /> '.
                                    'Los campos marcados con (*) asterisco son obligatorios.';

        //se cargan los datos para el formulario y el menu.
        $data['editar_form'] = 0;
        $data['miembro_referencia'] = $miembro_id;
        $menu_data['mostrar_integrantes'] = 'TRUE';
        $menu_data['miembro_id'] = $miembro_id;
        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/hijo_agregar", $data);
		$this->load->view("footer");
    }

    function hijo_editar($miembro_id, $hijo_id)
    {
        if(empty($miembro_id) || empty($hijo_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_hijo_miembro($miembro_id, $hijo_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro e hijo no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $data['query'] = $this->miembro_modelo->obt_persona_x_id($hijo_id);
        $data['editar_form'] = 1;
        $data['miembro_referencia'] = $miembro_id;

        //verificar que si se obtuvieron los datos del hijo sino
        //devuelve un mensaje que se debe mostrar en la pagina listado
        if (!is_string($data['query']))
        {
            //traigo los datos del miembro para colocar en la cabecera
            $result = $this->miembro_modelo->obt_x_id($miembro_id);
            $titulo = 'Editar hijo de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
            $data['miembro_fecha_nac'] = $result->prs_fecha_nacimiento;
            $data['titulo_form'] = $titulo;
            $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute;s editar los datos de un hijo de un miembro en la base de datos. Rellene el formulario para poder continuar con la tarea '.
                                        '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';

            $menu_data['mostrar_integrantes'] = 'TRUE';
            $menu_data['miembro_id'] = $miembro_id;

            $this->load->view("header");
            $this->load->view("menu",$this->info_modulo);
            $this->load->view("miembro/miembro_menu", $menu_data);
            $this->load->view("miembro/hijo_agregar", $data);
            $this->load->view("footer");
        }
        else //mostrar mensaje de error
        {
            $this->_mostrar_mensaje_miembro($data['query'],"miembro/listar_miembro/");
        }
    }

    function hijo_listar($miembro_id)
    {
        if(empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro no existe, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $data = array();
        $data['query'] = $this->miembro_modelo->obt_hijos_x_miembro($miembro_id);
        $data['miembro_id'] = $miembro_id;

        //traigo los datos del miembro para colocar en la cabecera
        $result = $this->miembro_modelo->obt_x_id($miembro_id);
        $titulo = 'Hijos de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos;
        $data['titulo_form'] = $titulo;
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute;s editar, pasar a miembro o eliminar los datos de un hijo de un miembro en la base de datos. Escoja una opci&oacute;n para poder continuar con la tarea ';

        $data['hijos_miembros'] = $this->miembro_modelo->obtener_hijos_miembros($miembro_id);

        $menu_data['mostrar_integrantes'] = 'TRUE';
        $menu_data['miembro_id'] = $miembro_id;

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/hijo_listado", $data);
		$this->load->view("footer");

    }

    function hijo_eliminar($miembro_id, $hijo_id)
    {
        if(empty($miembro_id) || empty($hijo_id))
        {
            $this->_mostrar_mensaje_miembro("Parametros incorrectos.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_hijo_miembro($miembro_id, $hijo_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro e hijo no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($hijo_id)=='TRUE')
        {
            $this->_mostrar_mensaje_miembro("Hijo es un miembro no se puede eliminar.FALSE", "miembro/listar_miembro/");
        }

        $this->miembro_modelo->eliminar_persona_relacion($miembro_id, $hijo_id, 100);
        $this->_mostrar_mensaje_miembro("Hijo ha sido eliminado.FALSE", "miembro/hijo_listar/".$miembro_id);

    }

    /* -------------------------------  FIN HIJO  ------------------------------ */


    /* -------------------------------  CONYUGUE  ------------------------------ */

    function conyugue_agregar($miembro_id)
    {
        if(empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Miembro no existe, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $query = $this->miembro_modelo->obt_conyugue_x_miembro($miembro_id);
        if(count($query) > 0)
        {
            redirect(base_url().'/miembro/conyugue_editar/'.$miembro_id);
        }

        //traigo los datos del miembro para colocar en la cabecera
        $result = $this->miembro_modelo->obt_x_id($miembro_id);
        $titulo = 'Agregar conyugue de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
        $data['titulo_form'] = $titulo;

        $data['editar_form'] = 0;
        $data['miembro_referencia'] = $miembro_id;
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; agregar los datos del conyugue de un miembro a la base de datos. Rellene el formulario para poder completar la tarea. <br /><br />'.
                                    'Los campos marcados con (*) asterisco son obligatorios.';

        $menu_data['mostrar_integrantes'] = 'TRUE';
        $menu_data['miembro_id'] = $miembro_id;
        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/conyugue_agregar", $data);
		$this->load->view("footer");
    }

    function conyugue_editar($miembro_id)
    {
        if(empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Miembro no existe, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $data['query'] = $this->miembro_modelo->obt_conyugue_x_miembro($miembro_id);
        if(count($data['query']) == 0)
        {
            redirect(base_url().'/miembro/conyugue_agregar/'.$miembro_id);
        }

        //traigo los datos del miembro para colocar en la cabecera
        $result = $this->miembro_modelo->obt_x_id($miembro_id);
        $titulo = 'Editar conyugue de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
        $data['titulo_form'] = $titulo;
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; editar los datos de un conyugue a la base de datos. Complete el formulario para poder completar la tarea.'.
                                    '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';;

        $data['editar_form'] = 1;
        $data['miembro_referencia'] = $miembro_id;
        $menu_data['mostrar_integrantes'] = 'TRUE';
        $menu_data['miembro_id'] = $miembro_id;
        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/conyugue_agregar", $data);
		$this->load->view("footer");
    }

    function conyugue_guardar()
    {
        $datos = $this->_obtener_datos_persona();

        $mensaje = '';
        $miembro_id = $this->input->post('miembro_id');
        $conyugue_id = '';
        $conyugue_id = $this->input->post('conyugue_id');

        if (empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        //si se ha asignado un hijo id es porque se va a editar
        //los datos del hijo
        if (empty($conyugue_id))
        {
            $mensaje = $this->miembro_modelo->insertar_conyugue($miembro_id, $datos);
        }else
        {
            $mensaje = $this->miembro_modelo->modificar_conyugue($miembro_id, $conyugue_id, $datos);
        }

        $this->_mostrar_mensaje_miembro($mensaje, "miembro/conyugue_editar/".$miembro_id."/");
    }

    function conyugue_eliminar($miembro_id, $conyugue_id)
    {
        if(empty($miembro_id) || empty($conyugue_id))
        {
            $this->_mostrar_mensaje_miembro("Parametros incorrectos.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_persona_relacion($miembro_id, $conyugue_id, 200)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro y conyugue no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $this->miembro_modelo->eliminar_persona_relacion($miembro_id, $conyugue_id, 200);
        $this->_mostrar_mensaje_miembro("Conyugue ha sido eliminado.FALSE", "miembro/listar_miembro/");

    }

    /* -------------------------------  FIN CONYUGUE  ------------------------------ */

    /* -------------------------------  OTRO  ------------------------------ */
     function otro_guardar()
    {
        $datos = $this->_obtener_datos_persona();

        $mensaje = '';
        $miembro_id = $this->input->post('miembro_id');
        $otro_id = '';
        $otro_id = $this->input->post('otro_id');

        if (empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametros incorrectos.FALSE", "miembro/listar_miembro/");
        }

        //si se ha asignado un otro id es porque se va a editar
        //los datos del otro
        if (empty($otro_id))
        {
            $mensaje = $this->miembro_modelo->insertar_otro($miembro_id, $datos);
        }else
        {
            $mensaje = $this->miembro_modelo->modificar_otro($miembro_id, $otro_id, $datos);
        }

        $this->_mostrar_mensaje_miembro($mensaje, "miembro/otro_listar/".$miembro_id."/");
    }

    function otro_agregar($miembro_id)
    {
        if(empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Miembro no existe, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        //traigo los datos del miembro para colocar en la cabecera
        $result = $this->miembro_modelo->obt_x_id($miembro_id);
        $titulo = 'Agregar otro familiar de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
        $data['titulo_form'] = $titulo;
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; agregar los datos de otra persona que reside con el miembro a la base de datos. Complete el formulario para poder completar la tarea.'.
                                    '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';
        $data['editar_form'] = 0;
        $data['miembro_referencia'] = $miembro_id;
        $menu_data['mostrar_integrantes'] = 'TRUE';
        $menu_data['miembro_id'] = $miembro_id;
        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/otro_agregar", $data);
		$this->load->view("footer");
    }

    function otro_editar($miembro_id, $hijo_id)
    {
        if(empty($miembro_id) || empty($hijo_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_persona_relacion($miembro_id, $hijo_id, 300)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro y otro integrante no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $data['query'] = $this->miembro_modelo->obt_persona_x_id($hijo_id);
        $data['editar_form'] = 1;
        $data['miembro_referencia'] = $miembro_id;

        //verificar que si se obtuvieron los datos del hijo sino
        //devuelve un mensaje que se debe mostrar en la pagina listado
        if (!is_string($data['query']))
        {
            //traigo los datos del miembro para colocar en la cabecera
            $result = $this->miembro_modelo->obt_x_id($miembro_id);
            $titulo = 'Editar otro familiar de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
            $data['titulo_form'] = $titulo;
            $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; editar los datos de otra persona que reside con el miembro a la base de datos. Complete el formulario para poder completar la tarea.'.
                                        '<br /><br />Los campos marcados con (*) asterisco son obligatorios.';

            $menu_data['mostrar_integrantes'] = 'TRUE';
            $menu_data['miembro_id'] = $miembro_id;

            $this->load->view("header");
            $this->load->view("menu",$this->info_modulo);
            $this->load->view("miembro/miembro_menu", $menu_data);
            $this->load->view("miembro/otro_agregar", $data);
            $this->load->view("footer");
        }
        else //mostrar mensaje de error
        {
            $this->_mostrar_mensaje_miembro($data['query'],"miembro/listar_miembro/");
        }
    }

    function otro_listar($miembro_id)
    {
        if(empty($miembro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($miembro_id)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro no existe, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $data = array();
        $data['query'] = $this->miembro_modelo->obt_otros_x_miembro($miembro_id);
        $data['miembro_id'] = $miembro_id;

        //traigo los datos del miembro para colocar en la cabecera
        $result = $this->miembro_modelo->obt_x_id($miembro_id);
        $titulo = 'Listar otros familiares de miembro - '.$result->prs_nombres.' '.$result->prs_apellidos.' - Documento: '. $result->prs_doc_num;
        $data['titulo_form'] = $titulo;
        $data['info_formulario'] = 'En esta secci&oacute;n podr&aacute; editar o eliminar los datos de otra persona que reside con el miembro en la base de datos. Escoja una opción para poder continuar con la tarea';
        $menu_data['mostrar_integrantes'] = 'TRUE';
        $menu_data['miembro_id'] = $miembro_id;

        $data['otros_miembros'] = $this->miembro_modelo->obtener_otros_miembros($miembro_id);

        $this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
        $this->load->view("miembro/miembro_menu", $menu_data);
		$this->load->view("miembro/otro_listado", $data);
		$this->load->view("footer");

    }

    function otro_eliminar($miembro_id, $otro_id)
    {
        if(empty($miembro_id) || empty($otro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametros incorrectos.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_persona_relacion($miembro_id, $otro_id, 300)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro y otro familiar no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        $this->miembro_modelo->eliminar_persona_relacion($miembro_id, $otro_id, 300);
        $this->_mostrar_mensaje_miembro("Otro familiar ha sido eliminado.TRUE", "miembro/otro_listar/".$miembro_id);
    }

    function otro_a_miembro($miembro_id, $otro_id)
    {
        if(empty($miembro_id) || empty($otro_id))
        {
            $this->_mostrar_mensaje_miembro("Parametro incorrecto.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_persona_relacion($miembro_id, $otro_id, 300)=='FALSE')
        {
            $this->_mostrar_mensaje_miembro("Codigo de miembro y otro familiar no coinciden, favor verificar parametros.FALSE", "miembro/listar_miembro/");
        }

        if($this->miembro_modelo->verificar_miembro_existe($otro_id)=='TRUE')
        {
            $this->_mostrar_mensaje_miembro("Este familiar ya es miembro.FALSE", "miembro/listar_miembro/");
        }

        $dato_hijo = $this->miembro_modelo->obt_persona_x_id($otro_id);
        $fecha_nac = date("Y-m-d", strtotime($dato_hijo->prs_fecha_nacimiento));
		if ($this->myutils->mayor_de_edad($fecha_nac) == FALSE){
            $this->_mostrar_mensaje_miembro("Otro familiar no es mayor de edad, verificar.FALSE", "miembro/listar_miembro/");
        }

        if ($this->miembro_modelo->persona_a_miembro($otro_id)=='TRUE')
        {
            $this->_mostrar_mensaje_miembro("El familiar a sido asignado como miembro.TRUE", "miembro/listar_miembro/");
        }else
        {
            $this->_mostrar_mensaje_miembro("El familiar no ha sido asignado como miembro.FALSE", "miembro/listar_miembro/");
        }
    }
    /* -------------------------------  FIN OTRO  ------------------------------ */


    /* -------------------------------  FUNCIONES PRIVADAS  ------------------------------ */
    /**
     *  Esta funcion crear los links para la paginacion
     *  de acuerdo a los parametros que le paso.
     */
    function _crear_paginacion($url, $cantidad, $por_pagina)
    {
        // configuro el paginador
		$config['base_url']     = $url;
		$config['total_rows']   = $cantidad;
		$config['per_page']     = $por_pagina;

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
        return $this->pagination->create_links();
    }

    /**
     * Esta funcion devuelve un array con los datos de personas
     * extraidos del formulario enviado por el cliente.
     */
     function _obtener_datos_persona()
    {
        $datos = array();
        if (strtotime($this->input->post('usr_fecha_nac')) == TRUE){
            $datos['prs_fecha_nacimiento'] = $this->input->post('usr_fecha_nac');
        }else{
            $datos['prs_fecha_nacimiento'] = null;
        }

        if (strtotime($this->input->post('usr_bautizado_fec')) == TRUE){
            $datos['prs_bautismo'] = $this->input->post('usr_bautizado_fec');
        }else{
            $datos['prs_bautismo'] = null;
        }

        if (strtotime($this->input->post('usr_defunsion_fec')) == TRUE){
            $datos['prs_defunsion'] = $this->input->post('usr_defunsion_fec');
        }else{
            $datos['prs_defunsion'] = null;
        }

        $datos['prs_apellidos'] = $this->input->post('usr_apellidos');
        $datos['prs_nombres'] = $this->input->post('usr_nombres');
        $datos['prs_doc_num'] = $this->input->post('usr_doc_num');
        $datos['prs_direccion'] = $this->input->post('usr_domic');
        $datos['prs_telefono'] = $this->input->post('usr_tel');
        $datos['prs_email'] = $this->input->post('usr_email');
        $datos['prs_sexo'] = $this->input->post('sexo');
        $datos['prs_lugar_nacimiento'] = $this->input->post('usr_lugar_nac');
        $datos['prs_bautizado'] = $this->input->post('usr_bautizado');
        $datos['prs_lugar_bautismo'] = $this->input->post('usr_lugar_bautizado');
        $datos['prs_lugar_sepultado'] = $this->input->post('usr_lugar_sepultado');
        $datos['prs_confirmado'] = $this->input->post('usr_confirmado');
        $datos['prs_casado'] = $this->input->post('usr_casado');
        $datos['prs_observacion'] = $this->input->post('usr_obs');
        $datos['cnf_id'] = $this->input->post('cnf');
        $datos['cmn_id'] = $this->input->post('cmn');

        return $datos;
    }

    /**
     * Esta funcion muestra la pagina indicada por el parametro
     * y agrega un mensaje para que se pueda mostrar en dicha pagina.
     */
    function _mostrar_mensaje_miembro($retorno, $url_destino)
    {
        $result = explode('.', $retorno);
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

        redirect(base_url().$url_destino);
    }
}

/* End of miembro.php */
/* Location: ./motor/controllers/miembro.php */
?>