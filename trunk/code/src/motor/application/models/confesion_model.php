<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Confesion_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_confesion  = 'confesion';
    var $cmp_cnf_id = 'cnf_id';
    var $cmp_cnf_nombre = 'cnf_nombre';

    function Confesion_model()
    {
        // Call the Model constructor
        parent::Model();
        $this->load->library('audit');
       
    }

    function obt_todos()
    {
        $query = $this->db->get($this->tabla_confesion);

        return $query->result();
    }

    function total_confesiones()
    {
        return $this->db->count_all($this->tabla_confesion);
    }


    /** obtiene una lista de los usuarios y sus datos */
    function obtener_confesiones($items_x_page, $limite, $sort = '')
    {
        $this->db->limit($items_x_page, $limite);
        if(!empty($sort)){
            $result = explode('.', $sort);
            $this->db->order_by($result[0], $result[1]);
        }
        $query = $this->db->get($this->tabla_confesion);
        return $query->result();
    }

    function insertar()
    {
		if ($this->input->post('con_nombre') != NULL)
		{
			$data = array(
               $this->cmp_cnf_nombre => $this->input->post('con_nombre'));

			$this->db->insert($this->tabla_confesion, $data);

			return "Se ha aguardado la confesion.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }

	function modificar()
	{
		if ($this->input->post('con_codigo')!= NULL &&
			$this->input->post('con_nombre') != NULL)
		{
			$id = $this->input->post('con_codigo');

			$query = $this->db->get_where($this->tabla_confesion, array($this->cmp_cnf_id => $id), 0, 100);

			if ($query->num_rows <> 1)
			{
				$data = array(
				$this->cmp_cnf_nombre => $this->input->post('con_nombre'));
                $this->audit->begin_audit($this->session->userdata('user_id'),$this->db );
				$this->db->where($this->cmp_cnf_id, $id);
				$this->db->update($this->tabla_confesion, $data);
                $this->audit->end_audit($this->db);
				return "Se ha modificado con exito la confesion.TRUE";
			}else
			{
				return "El codigo de confesion no es correcto.FALSE";
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
			$query = $this->db->get_where($this->tabla_confesion, array($this->cmp_cnf_id => $id), 0, 100);

			//si existe entonces se elimina si no, se envia en mensaje de error
			if ($query->num_rows <> 1)
			{
				$this->db->delete($this->tabla_confesion, array($this->cmp_cnf_id => $id));
				return "Se ha eliminado la confesion.TRUE";
			}else
			{
				return "El codigo de confesion no es correcto.FALSE";
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

		$this->db->like($this->cmp_cnf_nombre, $word);
		$query = $this->db->get($this->tabla_confesion);

		return $query->result();
	}

	function obt_x_id($id)
	{
		$query = $this->db->get_where($this->tabla_confesion, array($this->cmp_cnf_id => $id), 16, 0);
		return $query->result();
	}

     /** chequeo de existencia previa */
	function confesion_existe($con_desc, $con_id){

        $this->db->where("cnf_nombre", $con_desc);
        if ($con_id != NULL && $con_id != ''){
            $this->db->where("cnf_id != $con_id");
        }

        $query = $this->db->get('confesion');

        //$query = $this->db->get_where('persona', array('prs_doc_num' => $docnum));
		$result = $query->result();
		if(!empty($result)){
			return true;
		}else{
			return false;
		}
	}
}

/* Fin de archivo confesion_model.php */
/* Ubicacion: ./motor/models/confesion_model.php */
?>