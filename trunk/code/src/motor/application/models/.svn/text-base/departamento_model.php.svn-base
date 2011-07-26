<?php

class Departamento_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_departamento = 'departamento';
    var $cmp_dto_id         = 'dto_id';
    var $cmp_dto_nombre     = 'dto_nombre';
	var $cmp_pais_id        = 'pais_id';
	var $cmp_pais_nombre    = 'pais_nombre';

    function Departamento_model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function obt_todos()
    {
        $this->db->select('*');
        $this->db->from($this->tabla_departamento);
        $this->db->JOIN('pais','departamento.pais_id = pais.pais_id');
        $query = $this->db->get();
        return $query->result();
    }
	
	  function filtrar_x_pais($id)
    {
        $this->db->select('*');
        $this->db->from($this->tabla_departamento);
        $this->db->JOIN('pais','departamento.pais_id = pais.pais_id');
		$this->db->where('departamento.pais_id',$id);
        $query = $this->db->get();
        return $query->result();
    }
	

    function insertar()
    {
		if ($this->input->post('dto_nombre') != NULL)
		{
			$data = array($this->cmp_dto_nombre => $this->input->post('dto_nombre'),
			$this->cmp_pais_id => $this->input->post('pais_id'));

			$this->db->insert($this->tabla_departamento, $data);

			return "Se ha guardado la departamento.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }

	function modificar()
	{
		if ($this->input->post('dto_codigo')!= NULL &&
			$this->input->post('dto_nombre') != NULL &&
			$this->input->post('pais_id') != NULL)
		{
			$id = $this->input->post('dto_codigo');

			$query = $this->db->get_where($this->tabla_departamento, array($this->cmp_dto_id => $id), 0, 100);

			if ($query->num_rows <> 1)
			{
				$data = array(
					$this->cmp_dto_nombre => $this->input->post('dto_nombre'),
					$this->cmp_pais_id => $this->input->post('pais_id'));

					$this->db->where($this->cmp_dto_id, $id);
					$this->db->update($this->tabla_departamento, $data);
					return "Se ha modificado con exito la departamento.TRUE";
			}else
			{
				return "El codigo de departamento no es correcto.FALSE";
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
			//hago un load del objeto para asegurar que existe en la base de datos, controlo de integridad referencial
			$query = $this->db->get_where($this->tabla_departamento, array($this->cmp_dto_id => $id), 0, 100);

			//si existe entonces se elimina si no, se envia en mensaje de error
			if ($query->num_rows <> 1)
			{
				$this->db->delete($this->tabla_departamento, array($this->cmp_dto_id => $id));
				return "Se ha eliminado la departamento.TRUE";
			}else
			{
				return "El codigo de departamento no es correcto.FALSE";
			}
		}else
		{
			return "Parametros incorrectos.FALSE";
		}
	}

	function buscar()
	{
		if ($this->input->post('dto_buscar')== NULL )
		{
			return "Parametros incorrectos.FALSE";
		}

		$text = $this->input->post('dto_buscar');
		$this->db->like($this->cmp_dto_nombre, $text);
		$query = $this->db->get($this->tabla_departamento);

		return $query->result();
	}

	function obt_x_id($id)
	{
		$query = $this->db->get_where($this->tabla_departamento, array($this->cmp_dto_id => $id), 16, 0);
		return $query->result();
	}
}
/* Fin de archivo departamento_model.php */
/* Ubicacion: ./motor/models/departamento_model.php */

?>
