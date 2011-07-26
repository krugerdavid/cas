<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Comunidad_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_comunidad  = 'comunidad';
    var $cmp_cmn_id = 'cmn_id';
    var $cmp_cmn_nombre = 'cmn_nombre';

    function Comunidad_model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function obt_todos()
    {
        $query = $this->db->get($this->tabla_comunidad);
        return $query->result();
    }

    function total_comunidades()
    {
        return $this->db->count_all($this->tabla_comunidad);
    }

    function obtener_departamento($dto_id){
        
        $query = $this->db->get_where('departamento', array("dto_id" => $dto_id));
        $dpto = $query->row();
        return $dpto->dto_nombre;
        
    }

    /** obtiene una lista de los usuarios y sus datos */
    function obtener_comunidades($items_x_page, $limite, $sort = '')
    {

        $this->db->limit($items_x_page, $limite);
        //$this->db->select('*');
        //$this->db->from($this->tabla_comunidad);
        //$this->db->JOIN('departamento','departamento.dto_id = comunidad.dto_id');
        if(!empty($sort)){

            $result = explode('.', $sort);


            $this->db->order_by($result[0], $result[1]);
        }

        $query = $this->db->get($this->tabla_comunidad);
        //echo $this->db->last_query();
        return $query->result();
    }

    function obtener_departamentos()
    {
        //$query = $this->db->get_where('departamento', array('pais_id' => '1'), 0, 100);
        $query = $this->db->get('departamento');
        return $query->result();
    }


    function insertar()
    {
		if ($this->input->post('com_nombre') != NULL)
		{
			$data = array(
                $this->cmp_cmn_nombre => $this->input->post('com_nombre'),
                'pais_id' => '1',
                'dto_id' => $this->input->post('dto_id'));

			$this->db->insert($this->tabla_comunidad, $data);

			return "Se ha guardado la comunidad.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }

	function modificar()
	{
		if ($this->input->post('com_codigo')!= NULL &&
			$this->input->post('com_nombre') != NULL)
		{
			$id = $this->input->post('com_codigo');

			$query = $this->db->get_where($this->tabla_comunidad, array($this->cmp_cmn_id => $id), 0, 100);

			if ($query->num_rows <> 1)
			{
				$data = array(
					$this->cmp_cmn_nombre => $this->input->post('com_nombre'),
                    'pais_id' => '1',
                    'dto_id' => $this->input->post('dto_id'));

				$this->db->where($this->cmp_cmn_id, $id);
				$this->db->update($this->tabla_comunidad, $data);
				return "Se ha modificado con exito la comunidad.TRUE";
			}else
			{
				return "El codigo de comunidad no es correcto.FALSE";
			}
		}else
		{
			return "Parametros incorrectos.FALSE";
		}
	}

	function eliminar($id)
	{
		if (isset($id))
		{
			//hago un load del objeto para asegurar que existe en la base de datos
			$query = $this->db->get_where($this->tabla_comunidad, array($this->cmp_cmn_id => $id), 0, 100);

			//si existe entonces se elimina si no, se envia en mensaje de error
			if ($query->num_rows <> 1)
			{
				$this->db->delete($this->tabla_comunidad, array($this->cmp_cmn_id => $id));
				return "Se ha eliminado la comunidad.TRUE";
			}else
			{
				return "El codigo de comunidad no es correcto.FALSE";
			}
		}else
		{
			return "Parametros incorrectos.FALSE";
		}
	}

	function buscar($word)
	{
        if ($word == NULL || $word == "" || empty ($word))
		{
			return;
		}

		//$text = $this->input->post('com_buscar');
		$this->db->like($this->cmp_cmn_nombre, $word);
		$query = $this->db->get($this->tabla_comunidad);
        //echo $this->db->last_query();
        return $query->result();
	}

	function obt_x_id($id)
	{
		$query = $this->db->get_where($this->tabla_comunidad, array($this->cmp_cmn_id => $id), 16, 0);
		return $query->row();
	}

     /** chequeo de existencia previa */
	function comunidad_existe($com_desc, $dpto, $com_id){

        $this->db->where("cmn_nombre", $com_desc);
        $this->db->where("dto_id", $dpto);
        if ($com_id != NULL && $com_id != ''){
            $this->db->where("cmn_id != $com_id");
        }

        $query = $this->db->get('comunidad');

        //$query = $this->db->get_where('persona', array('prs_doc_num' => $docnum));
		$result = $query->result();
		if(!empty($result)){
			return true;
		}else{
			return false;
		}
	}
}
/* Fin de archivo comunidad_model.php */
/* Ubicacion: ./motor/models/comunidad_model.php */

?>
