<?php

class Miembro_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_persona  = 'persona';
    var $tabla_miembro  = 'miembro';
    var $cmp_prs_id = 'prs_id';
    var $cmp_mmb_id = 'mmb_id';

    function Miembro_model()
    {
        // Call the Model constructor
        parent::Model();

    }

    function insertar($data)
    {
        $ultimo_prs = $this->insertar_persona($data);

        $ahora = date($this->config->item('formato_fecha'));
        $miembro = array();
        $miembro['mmb_id'] = $ultimo_prs;
        $miembro['mmb_miembro_desde'] = $ahora;

        $this->db->insert($this->tabla_miembro, $miembro);

        return "Se ha guardado la persona con exito.TRUE";
    }

    function modificar($id, $data)
    {
        $this->db->where($this->cmp_prs_id, $id);
        $this->db->update($this->tabla_persona, $data);

         return "Se ha modificado los datos del miembro con exito.TRUE";
    }

    function obt_x_id($id)
    {
        $this->db->where($this->cmp_mmb_id, $id);
        $query = $this->db->get($this->tabla_miembro);

        if (count($query->row()) <> 1)
        {
            return "Codigo de miembro ingresado incorrecto.FALSE";
        }
        
        return $this->obt_persona_x_id($id);
    }

    function obt_persona_x_id($id)
    {
        $this->db->where($this->cmp_prs_id, $id);
        $query = $this->db->get($this->tabla_persona);

        if (count($query->row()) == 1)
        {
            return $query->row();
        }else
        {
            return "Codigo de persona ingresado incorrecto.FALSE";
        }
    }

    /** chequeo de existencia previa */
	function documento_numero_existe($docnum, $miembro_id){

        $this->db->where("prs_doc_num = '$docnum'");
        if ($miembro_id != NULL && $miembro_id != ''){
            $this->db->where("prs_id != $miembro_id");
        }
            
        $query = $this->db->get('persona');

        //$query = $this->db->get_where('persona', array('prs_doc_num' => $docnum));
		$result = $query->result();
		if(!empty($result)){
			return true;
		}else{
			return false;
		}
	}

    function obt_todos()
    {
        $query = $this->db->query('select * from persona, miembro where persona.prs_id = miembro.mmb_id');
        return $query->result();
    }

    function cantidad_miembros()
    {
        return $this->db->count_all_results($this->tabla_miembro);
    }

    function total_aportes()
    {
        return $this->db->count_all_results("aporte");
    }

    function obtener_aportes($limite, $desde, $sort = '')
    {
        $this->db->limit($limite, $desde);

        if(!empty($sort)){
            $result = explode('.', $sort);
            $this->db->order_by($result[0], $result[1]);
        }

        $query = $this->db->get("aporte");

        return $query->result();
    }

    function obtener_miembros($limite, $desde, $sort = '')
    {
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->JOIN('miembro','miembro.mmb_id = persona.prs_id');
        $this->db->limit($limite, $desde);

        if(!empty($sort)){
            $result = explode('.', $sort);
            $this->db->order_by($result[0], $result[1]);
        }

        $query = $this->db->get();

        return $query->result();
    }

    function buscar_en_lista($busqueda, $limite, $desde)
    {
        $results = array();
        
        $this->db->select('*');
        $this->db->from('persona');
        $this->db->JOIN('miembro','miembro.mmb_id = persona.prs_id');
        $this->db->like('prs_apellidos', $busqueda);
        $this->db->or_like('prs_nombres', $busqueda);
        $this->db->limit($limite, $desde);
        $query = $this->db->get();
        
        $results['data'] = $query->result();

        $this->db->from('persona');
        $this->db->JOIN('miembro','miembro.mmb_id = persona.prs_id');
        $this->db->like('prs_apellidos', $busqueda);
        $this->db->or_like('prs_nombres', $busqueda);
        $this->db->limit($limite, $desde);

        $results['cantidad'] = $this->db->count_all_results();

        return $results;
    }

    function buscar_miembro_aporte($busqueda, $limite, $desde)
    {
        $results = array();

        $this->db->select('*');
        $this->db->from('persona');
        $this->db->JOIN('miembro','miembro.mmb_id = persona.prs_id');
        $this->db->like('prs_estado', 'A');
        $this->db->like('prs_apellidos', $busqueda);
        $this->db->or_like('prs_nombres', $busqueda);
        $this->db->limit($limite, $desde);
        $query = $this->db->get();

        //$results['data'] = $query->result();

        return $query->result();
    }

    function obtener_hijos_miembros($miembro_id)
    {
        $hijo_relacion_codigo = 100;
        $query_str = 'select * from miembro where mmb_id in ('.
        'select prs.prs_id from persona prs where prs.prs_id in ('.
        'select prr.prs_id from persona_relacion prr where prr.mmb_id = '
        .$miembro_id .' && prr.rlc_id = '.$hijo_relacion_codigo.'))';
        $query = $this->db->query($query_str);

        $results = array();
        foreach ($query->result() as $row)
        {
            $results[$row->mmb_id] = 'TRUE';
        }

        return $results;
    }

    function obtener_otros_miembros($miembro_id)
    {
        $otro_relacion_codigo = 300;
        $query_str = 'select * from miembro where mmb_id in ('.
        'select prs.prs_id from persona prs where prs.prs_id in ('.
        'select prr.prs_id from persona_relacion prr where prr.mmb_id = '
        .$miembro_id .' && prr.rlc_id = '.$otro_relacion_codigo.'))';
        $query = $this->db->query($query_str);

        $results = array();
        foreach ($query->result() as $row)
        {
            $results[$row->mmb_id] = 'TRUE';
        }

        return $results;
    }

    function persona_a_miembro($persona_id)
    {
        $ahora = date($this->config->item('formato_fecha'));
        $miembro = array();
        $miembro['mmb_id'] = $persona_id;
        $miembro['mmb_miembro_desde'] = $ahora;

        $this->db->insert($this->tabla_miembro, $miembro);

        return "TRUE";
    }

    function cambiar_estado_persona($persona_id)
    {
        $estado_nuevo = '';
        $estado_actual = $this->obtener_estado_persona($persona_id);

        $estado_nuevo = ($estado_actual == 'A') ? 'I' : 'A';

        $data = array(
               'prs_estado' => $estado_nuevo);

        $this->db->where($this->cmp_prs_id, $persona_id);
        $this->db->update($this->tabla_persona, $data);
    }

    function obtener_estado_persona($persona_id)
    {
        $this->db->where($this->cmp_prs_id, $persona_id);
        $query = $this->db->get($this->tabla_persona);

        if (count($query->row()) == 1)
        {
            return $query->row()->prs_estado;
        }else
        {
            return "Codigo de persona ingresado incorrecto.FALSE";
        }
    }

    function eliminar_persona_relacion($miembro_id, $hijo_id, $tipo_relacion)
    {
        $this->db->where('prs_id', $hijo_id);
        $this->db->where('mmb_id', $miembro_id);
        $this->db->where('rlc_id', $tipo_relacion);
        $this->db->delete('persona_relacion');

        $this->db->where($this->cmp_prs_id, $hijo_id);
        $this->db->delete($this->tabla_persona);

        return "Persona eliminada. TRUE";
    }

    function insertar_persona($data)
    {
        $this->db->insert($this->tabla_persona, $data);

        $this->db->select_max($this->cmp_prs_id, 'prs_max');
        $consulta_rol = $this->db->get($this->tabla_persona);
        $prs_fila = $consulta_rol->row();
        $ultimo_prs = $prs_fila->prs_max;

        return $ultimo_prs;
    }

    function insertar_hijo($miembro_id, $data)
    {
        $persona_id = $this->insertar_persona($data);

        $hijo_datos = array();
        $hijo_datos['prs_id'] = $persona_id;
        $hijo_datos['mmb_id'] = $miembro_id;
        $hijo_datos['rlc_id'] = 100;

        $this->db->insert('persona_relacion', $hijo_datos);

        return "Se han guardado los datos del hijo en forma correcta.TRUE";
    }

    function modificar_hijo($miembro_id, $hijo_id, $data)
    {
        if ($this->verificar_hijo_miembro($miembro_id, $hijo_id) == 'FALSE')
        {
            return "Datos de miembro e hijo no coinciden.TRUE";
        }
        
        $this->db->where($this->cmp_prs_id, $hijo_id);
        $this->db->update($this->tabla_persona, $data);

        return "Se han modificado los datos del hijo con exito.TRUE";
    }

    function verificar_hijo_miembro($miembro_id, $hijo_id)
    {
        $this->db->select('*');
        $this->db->from('persona_relacion');
        $this->db->where('prs_id', $hijo_id);
        $this->db->where('mmb_id', $miembro_id);
        $this->db->where('rlc_id', 100);
        $query = $this->db->get();

        if (count($query->row()) == 1)
        {
            return 'TRUE';
        }else
        {
            return 'FALSE';
        }
    }

    function verificar_persona_relacion($miembro_id, $hijo_id, $tipo_relacion)
    {
        $this->db->select('*');
        $this->db->from('persona_relacion');
        $this->db->where('prs_id', $hijo_id);
        $this->db->where('mmb_id', $miembro_id);
        $this->db->where('rlc_id', $tipo_relacion);
        $query = $this->db->get();

        if (count($query->row()) == 1)
        {
            return 'TRUE';
        }else
        {
            return 'FALSE';
        }
    }


    function verificar_miembro_existe($miembro_id)
    {
         $this->db->from('miembro');
         $this->db->where('mmb_id', $miembro_id);
         $query = $this->db->get();

        if (count($query->row()) == 1)
        {
            return 'TRUE';
        }else
        {
            return 'FALSE';
        }
    }


    function obt_hijos_x_miembro($miembro_id)
    {
        $hijo_relacion_codigo = 100;
        $query = $this->db->query('select * from persona prs where '
            .'prs.prs_id in (select prr.prs_id from '
            .'persona_relacion prr where prr.mmb_id = '.$miembro_id
            .' and prr.rlc_id = '.$hijo_relacion_codigo.')');
        
        return $query->result();
    }

    function obt_conyugue_x_miembro($miembro_id)
    {
        $conyugue_relacion_codigo = 200;
        $query = $this->db->query('select * from persona prs where '
            .'prs.prs_id in (select prr.prs_id from '
            .'persona_relacion prr where prr.mmb_id = '.$miembro_id
            .' and prr.rlc_id = '.$conyugue_relacion_codigo.')');

        return $query->row();
    }

    function insertar_conyugue($miembro_id, $data)
    {
        $persona_id = $this->insertar_persona($data);

        $conyugue_datos = array();
        $conyugue_datos['prs_id'] = $persona_id;
        $conyugue_datos['mmb_id'] = $miembro_id;
        $conyugue_datos['rlc_id'] = 200;

        $this->db->insert('persona_relacion', $conyugue_datos);

        return "Se han guardado los datos del conyugue en forma correcta.TRUE";
    }

    function modificar_conyugue($miembro_id, $conyugue_id, $data)
    {
        if ($this->verificar_persona_relacion($miembro_id, $hijo_id, 200) == 'FALSE')
        {
            return "Datos de miembro y conyugue no coinciden.TRUE";
        }

        $this->db->where($this->cmp_prs_id, $conyugue_id);
        $this->db->update($this->tabla_persona, $data);

        return "Se han modificado los datos del conyugue con exito.TRUE";
    }

    function insertar_otro($miembro_id, $data)
    {
        $persona_id = $this->insertar_persona($data);

        $hijo_datos = array();
        $hijo_datos['prs_id'] = $persona_id;
        $hijo_datos['mmb_id'] = $miembro_id;
        $hijo_datos['rlc_id'] = 300;

        $this->db->insert('persona_relacion', $hijo_datos);

        return "Se han guardado los datos del integrante de familia en forma correcta.TRUE";
    }

    function modificar_otro($miembro_id, $otro_id, $data)
    {
        if ($this->verificar_persona_relacion($miembro_id, $otro_id, 300) == 'FALSE')
        {
            return "Datos de miembro y otro integrante no coinciden.TRUE";
        }

        $this->db->where($this->cmp_prs_id, $otro_id);
        $this->db->update($this->tabla_persona, $data);

        return "Se han modificado los datos del integrante de la familia con exito.TRUE";
    }

    function obt_otros_x_miembro($miembro_id)
    {
        $otro_relacion_codigo = 300;
        $query = $this->db->query('select * from persona prs where '
            .'prs.prs_id in (select prr.prs_id from '
            .'persona_relacion prr where prr.mmb_id = '.$miembro_id
            .' and prr.rlc_id = '.$otro_relacion_codigo.')');

        return $query->result();
    }

    function insertar_aporte($datos)
    {
        $this->db->insert('aporte', $datos);

        return "Se ha guardado el aporte con exito.TRUE";
    }
    
    function modificar_aporte($id, $data)
    {
        $this->db->where('apr_id', $id);
        $this->db->update('aporte', $data);

        return "Se ha guardado el aporte con exito.TRUE";
    }

    function obt_aporte_x_id($aporte_id)
    {
        $this->db->from('aporte');
        $this->db->where('apr_id', $aporte_id);
        $query = $this->db->get();
        
        return $query->row();
    }

    function eliminar($rol_id)
	{
/*        $this->db->where($this->cmp_rol_id, $rol_id);
        $this->db->delete($this->tabla_permisoxrol);

        $this->db->where($this->cmp_rol_id, $rol_id);
        $this->db->delete($this->tabla_rol);

        return "Se ha eliminado el rol.TRUE";*/
    }

  	function buscar()
	{
		/*if ($this->input->post('rol_buscar')== NULL )
		{
			return "Parametros incorrectos.FALSE";
		}

		$text = $this->input->post('rol_buscar');
		$this->db->like($this->cmp_rol_nombre, $text);
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

        return $query->result();*/
    }
}
/* Fin de archivo miembro_model.php */
/* Ubicacion: ./motor/models/miembro_model.php */

?>
