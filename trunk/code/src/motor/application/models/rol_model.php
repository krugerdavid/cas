<?php

class Rol_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_permiso      = 'permiso';
    var $tabla_rol          = 'rol';
    var $tabla_permisoxrol  = 'permiso_x_rol';
    var $cmp_rol_id         = 'rol_id';
    var $cmp_prm_id         = 'prm_id';
    var $cmp_rol_nombre     = 'rol_nombre';

    function Rol_model()
    {
        // Call the Model constructor
        parent::Model();

    }

    function obt_permisos()
    {
        $query = $this->db->get($this->tabla_permiso);

        return $query->result();
    }

    function obt_todos()
    {
        $query = $this->db->get($this->tabla_rol);

        return $query->result();
    }

    function obt_permiso_x_rol($id_rol)
    {
        $this->db->select("prm_id as permiso, prm_nombre, if((select rol_id from permiso_x_rol where rol_id={$id_rol} and prm_id=permiso) is NULL, '', 'checked') as checked", FALSE);
        $query = $this->db->get($this->tabla_permiso);
        return $query->result();
    }

    function obt_rol_x_id($id_rol)
    {
        $this->db->where($this->cmp_rol_id, $id_rol);
        $query = $this->db->get($this->tabla_rol);

        if (count($query->row()) == 1)
        {
            return $query->row();
        }else
        {
            return "Codigo ingresado incorrecto.FALSE";
        }
    }

    function insertar()
    {
		if ($this->input->post('rol_nombre') != NULL)
		{
			$data = array(
               $this->cmp_rol_nombre => $this->input->post('rol_nombre'));

			$this->db->insert($this->tabla_rol, $data);

            $this->db->select_max($this->cmp_rol_id, 'rol_max');
            $consulta_rol = $this->db->get($this->tabla_rol);
            $rol_fila = $consulta_rol->row();
            $ultimo_rol = $rol_fila->rol_max;

            $permisos = $this->input->post("permiso");

            for ($i=0; $i<count($permisos); $i++) {
                if ($permisos[$i] != NULL)
                {
                    $roles = array(
                        $this->cmp_rol_id => $ultimo_rol,
                        $this->cmp_prm_id => $permisos[$i]);

                    $this->db->insert($this->tabla_permisoxrol, $roles);
                }
            }

			return "Se ha guardado el rol.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }
    
    function modificar()
    {
		if ($this->input->post('rol_nombre') != NULL)
		{
			$data = array(
               $this->cmp_rol_nombre => $this->input->post('rol_nombre'));

			$this->db->where($this->cmp_rol_id, $this->input->post('rol_codigo'));
            $this->db->update($this->tabla_rol, $data);

            $this->db->where($this->cmp_rol_id, $this->input->post('rol_codigo'));
            $this->db->delete($this->tabla_permisoxrol);

            $permisos = $this->input->post("permiso");
            //echo "cantidad: ".count($permisos)." tiene: ".$permisos[0];

            for ($i=0; $i<count($permisos); $i++) {
                if ($permisos[$i] != NULL)
                {
                    $roles = array(
                        $this->cmp_rol_id => $this->input->post('rol_codigo'),
                        $this->cmp_prm_id => $permisos[$i]);

                    $this->db->insert($this->tabla_permisoxrol, $roles);
                }
            }
			return "Se han guardado los cambios.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }

    function eliminar($rol_id)
	{
        $this->db->where($this->cmp_rol_id, $rol_id);
        $this->db->delete($this->tabla_permisoxrol);

        $this->db->where($this->cmp_rol_id, $rol_id);
        $this->db->delete($this->tabla_rol);

        return "Se ha eliminado el rol.TRUE";
    }

  	function buscar($word)
	{
        if ($word == NULL || $word == "" || empty ($word))
		{
			return;
		}

		$this->db->like($this->cmp_rol_nombre, $word);
		$query = $this->db->get($this->tabla_rol);

		return $query->result();
	}

    function obt_permiso_x_roles($id_rol){
		$sql = 'select pr.rol_id, p.prm_nombre '.
		'from permiso_x_rol pr '.
		'inner join permiso p '.
		'on pr.prm_id=p.prm_id '.
		'where pr.rol_id='.$id_rol;

		$query = $this->db->query($sql);

        return $query->result();
    }

    /* FUNCIONES PARA EL AGREGADO Y EDITADO DE PERMISOS A UN ROL */
    function obtener_modulos()
    {
        $this->db->select('prm_controller, prm_modulo');
        $this->db->from('permiso, permiso_x_rol, rol');
        $this->db->where('permiso_x_rol.prm_id = permiso.prm_id');
        $this->db->where('permiso_x_rol.rol_id = rol.rol_id');
        $this->db->group_by('permiso.prm_modulo');
        $this->db->order_by('permiso.prm_id');

        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->result();
    }

    function obtener_permisos_modulo($modulo)
    {
        //debo obtener todos los modulos pertenecientes al rol que tiene el usuario
        $this->db->select('permiso.prm_id, permiso.prm_nombre, permiso.prm_controller_funcion');
        $this->db->from('permiso');
        $this->db->where('permiso.prm_controller',$modulo);
        $this->db->order_by('permiso.prm_id');
        $query = $this->db->get();

        //echo $this->db->last_query();
        return $query->result();
    }

}
/* Fin de archivo rol_model.php */
/* Ubicacion: ./motor/models/rol_model.php */
?>