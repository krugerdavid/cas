<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Usuario_model extends Model{

	/* CONSTRUCTOR */    
    var $_TABLAS        = array();

	function Usuario_model()
    {
		parent::Model();
        $this->_TABLAS['usuario']       = 'usuario';
        $this->_TABLAS['menu']          = 'menu';
        $this->_TABLAS['persona']       = 'persona';
        $this->_TABLAS['miembro']       = 'miembro';
        $this->_TABLAS['rol']           = 'rol';
        $this->_TABLAS['permiso_x_rol'] = 'permiso_x_rol';
        $this->_TABLAS['permiso']       = 'permiso';
        $this->_TABLAS['parametro']     = 'parametro';
        $this->load->library('audit');

	}
	
    /** Obtiene la tupla correspondiente un usuario y a su contrasena */
    function obtener_usuario($username, $pass)
    {
        $query = $this->db->get_where($this->_TABLAS['usuario'], array('usr_nombre'=>$username,  'usr_contrasena'=>$pass));
        $row = $query->row();
        return $row;
    }

    /** obtiene todos los datos de la persona mediante su id */
	function detalles_usuario($id)
    {
		//$query = $this->db->get_where($this->tabla_persona,array('prs_id' => $id));
		$this->db->select('*');
        $this->db->from('persona');
        $this->db->JOIN('usuario','usuario.prs_id = persona.prs_id');
        $this->db->where('usr_id',$id);
        $query = $this->db->get();
        return $query->row();
	}

    function actualizar_ultima_visita($fecha, $usr_id)
    {

        $data = array('usr_ultimo_login' => $fecha);
        $this->audit->begin_audit($this->session->userdata('user_id'));
        $this->db->where('usr_id', $usr_id);
        $this->db->update($this->_TABLAS['usuario'], $data);
        $this->audit->end_audit();
        return "TRUE";
    }

    function obtener_modulos_usuario($rol_id)
    {            
        //debo obtener todos los modulos pertenecientes al rol que tiene el usuario
        $this->db->select('permiso.prm_modulo, permiso.prm_controller');
        $this->db->from('permiso, permiso_x_rol, rol');
        $this->db->where('permiso_x_rol.prm_id = permiso.prm_id');
        $this->db->where('permiso_x_rol.rol_id = rol.rol_id');
        $this->db->where('rol.rol_id',$rol_id);
        $this->db->group_by('permiso.prm_modulo');
        $this->db->order_by('permiso.prm_id');
        $query = $this->db->get();
        return $query->result();
    }


    function obtener_permisos_usuario($rol_id, $mdl_nombre)
    {
        //debo obtener todos los modulos pertenecientes al rol que tiene el usuario
        $this->db->select('permiso.prm_id, permiso.prm_nombre, permiso.prm_controller, permiso.prm_controller_funcion');
        $this->db->from('permiso, permiso_x_rol, rol');
        $this->db->where('permiso_x_rol.prm_id = permiso.prm_id');
        $this->db->where('permiso_x_rol.rol_id = rol.rol_id');
        $this->db->where('rol.rol_id',$rol_id);
        $this->db->where('permiso.prm_modulo',$mdl_nombre);
        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->result();
    }

    /*
     * Obtiene los parametros establecidos para la aplicacion
     */
    function obtener_parametros()
    {
        $query = $this->db->get_where($this->_TABLAS['parametro'],array('par_id' => 1));
        return $query->row();
    }

    /*
     * Obtiene el nombre del rol del Usuario logeado
     */
     function obtener_rol($rol_id)
     {
        $query = $this->db->get($this->_TABLAS['rol'], array('rol_id' => $rol_id));
        $rol = $query->row();
        return $rol->rol_nombre;
     }

    /** obtiene los roles y permisos agregados recientemente */
    function obtener_roles($limite)
    {
        $query = $this->db->get($this->_TABLAS['rol'], $limite);
        return $query->result();
    }

    function obtener_detalles_permiso($nombre){
        $query = $this->db->get_where($this->_TABLAS['permiso'],array('prm_nombre' => $nombre));
		return $query->row();
	}

	/** usr_id, y modulo actual */
    function esta_habilitado($rol_id, $nombre_modulo){

        // obtengo todos los permisos de este rol
        $modulos = $this->obtener_modulos_usuario($rol_id);
        $modulos_habilitados = ' ';

        foreach($modulos as $item){
            $modulos_habilitados .= $item->prm_controller.' ';
        }

        //compruebo de que el modulo accedido pertene a este rol
        if(strpos($modulos_habilitados, $nombre_modulo)){
            return true;
        }else{
            return false;
        }
	}

    /** obtiene una lista de los usuarios y sus datos */
    function obtener_usuarios($items_x_page, $limite)
    {
        $this->db->select('usr_id, prs_nombres, prs_apellidos, usr_nombre, prs_email, usr_fecha_registro, usr_ultimo_login');
        $this->db->from('persona');
        $this->db->JOIN('usuario','usuario.prs_id = persona.prs_id');
        $this->db->limit($items_x_page, $limite);
        $query = $this->db->get();      
        return $query->result();
    }

    function total_usuarios()
    {
        return $this->db->count_all($this->_TABLAS['usuario']);
    }

	/** chequeo de existencia previa */
	function usuario_existe($usuario){

        $query = $this->db->get_where($this->_TABLAS['usuario'], array('usr_nombre' => $usuario));
		$result = $query->result();
		if(!empty($result)){
			return true;
		}else{
			return false;
		}
	}	

    function crear_usuario($nombre, $apellido, $correo, $usuario, $contrasena, $rol, $sexo, $documento, $fecha_nac, $lugar_nac, $casado, $comunidad, $confesion)
    {
        if(!empty($nombre) && !empty($apellido) && !empty($correo))
        {
            $fecha_registro = date($this->config->item('formato_fecha'));
            
            if($this->usuario_existe(addslashes($usuario))){
				return "existe";
			}else{

                // seteo los datos personales del nuevo usuario
                $datos_persona = array(
                    'prs_apellidos' => $apellido,
                    'prs_nombres'   => $nombre,
                    'prs_email'     => $correo,
                    'prs_sexo'      => $sexo,
                    'prs_doc_num'   => $documento,
                    'prs_fecha_nacimiento'   => $fecha_nac,
                    'prs_lugar_nacimiento'   => $lugar_nac,
                    'prs_casado'    => $casado,
                    'cnf_id'        => $confesion,
                    'cmn_id'        => $comunidad
                );

                if($this->db->insert($this->_TABLAS['persona'], $datos_persona)){

                    // seteo los datos de acceso para el nuevo usuario
                    $prs_id = $this->db->insert_id();                    
                    $datos_usuario = array(
                        'prs_id'            => $prs_id,
                        'rol_id'            => $rol,
                        'usr_super'         => 0,
                        'usr_nombre'        => $usuario,
                        'usr_contrasena'    => $contrasena,
                        'usr_fecha_registro'=> $fecha_registro
                    );

                    if($this->db->insert($this->_TABLAS['usuario'], $datos_usuario))
                    {
                        $agregado['estado'] = "agregado";
                        $agregado['query'] = $this->db->last_query();
                        return $agregado;
                    }else{
                        $agregado['estado'] = "noagregado";
                        $agregado['query'] = $this->db->last_query();
                        return $agregado;
                    }
                }
			}
            
        }else{
			return "vacio";
		}
    }
	
	function editar_usuario($usr_id, $prs_id, $nombre, $apellido, $correo, $usuario, $contrasena, $rol, $sexo, $documento, $fecha_nac, $lugar_nac, $casado, $comunidad, $confesion)
    {
        if(!empty($nombre) && !empty($apellido) && !empty($correo))
        {

            // seteo los datos personales del nuevo usuario
            $datos_persona = array(
                'prs_apellidos' => $apellido,
                'prs_nombres'   => $nombre,
                'prs_email'     => $correo,
                'prs_sexo'      => $sexo,
                'prs_doc_num'   => $documento,
                'prs_fecha_nacimiento'   => $fecha_nac,
                'prs_lugar_nacimiento'   => $lugar_nac,
                'prs_casado'    => $casado,
                'cnf_id'        => $confesion,
                'cmn_id'        => $comunidad
            );


            if($this->db->update($this->_TABLAS['persona'], $datos_persona,array('prs_id' => $prs_id))){

                $datos_usuario = array(
                        'prs_id'            => $prs_id,
                        'rol_id'            => $rol,
                        'usr_nombre'        => $usuario,
                        'usr_contrasena'    => $contrasena
                    );

                if($this->db->update($this->_TABLAS['usuario'], $datos_usuario,array('usr_id' => $usr_id))){
                    $estado['estado'] = "editado";
                    return $estado;
                }else{
                    $estado['estado'] = "noeditado";
                    return $estado;
                }
            }

        }else{
            return "vacio";
        }
    }

    function eliminar_usuario($id){

        $usuario = $this->detalles_usuario($id);

        //hago un load del objeto para asegurar que existe en la base de datos
        $query = $this->db->get_where($this->_TABLAS['miembro'], array('mmb_id' => $usuario->prs_id), 0,100);

        // checkeo si este usuario es un miembro
        $this->db->where('mmb_id',$usuario->prs_id);
        $this->db->from($this->_TABLAS['miembro']);
        $count = $this->db->count_all_results();

        //si existe entonces se elimina si no, se envia en mensaje de error
        if ($count < 1){

            if($usuario->usr_super != 1){
                $this->db->delete($this->_TABLAS['usuario'], array('usr_id'  => $id));
                $this->db->delete($this->_TABLAS['persona'], array('prs_id' => $usuario->prs_id));

                return "Se ha eliminado el usuario.TRUE";
            }else{
                return 'No se puede eliminar a este usuario ya que es el super admin.FALSE';
            }

        }else{
            return 'No se puede borrar este usuario porque es un miembro.FALSE';
        }

    }
	

	
}

/* End of usuario_model.php */
/* Location: ./motor/models/usuario_model.php */
?>