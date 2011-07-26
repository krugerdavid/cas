<?php

class Pais_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_pais  = 'pais';
    var $cmp_pais_id = 'pais_id';
    var $cmp_pais_nombre = 'pais_nombre';

    function Pais_model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function obt_todos()
    {
        $query = $this->db->get($this->tabla_pais);
        return $query->result();
    }

    function insertar()
    {
		if ($this->input->post('pais_nombre') != NULL)
		{
			$data = array($this->cmp_pais_nombre => $this->input->post('pais_nombre'));

			$this->db->insert($this->tabla_pais, $data);

			return "Se ha guardado el pais.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }

	function modificar()
	{
		if ($this->input->post('pais_codigo')!= NULL &&
			$this->input->post('pais_nombre') != NULL)
		{
			$id = $this->input->post('pais_codigo');

			$query = $this->db->get_where($this->tabla_pais, array($this->cmp_pais_id => $id), 0, 100);

			if ($query->num_rows <> 1)
			{
				$data = array(
					$this->cmp_pais_nombre => $this->input->post('pais_nombre'));

				$this->db->where($this->cmp_pais_id, $id);
				$this->db->update($this->tabla_pais, $data);
				return "Se ha modificado con exito el pais.TRUE";
			}else
			{
				return "El codigo del pais no es correcto.FALSE";
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
			$query = $this->db->get_where($this->tabla_pais, array($this->cmp_pais_id => $id), 0, 100);

			//si existe entonces se elimina si no, se envia en mensaje de error
			if ($query->num_rows <> 1)
			{
				$this->db->delete($this->tabla_pais, array($this->cmp_pais_id => $id));
				return "Se ha eliminado la pais.TRUE";
			}else
			{
				return "El codigo de pais no es correcto.FALSE";
			}
		}else
		{
			return "Parametros incorrectos.FALSE";
		}
	}

	function buscar()
	{
		if ($this->input->post('pais_buscar')== NULL )
		{
			return "Parametros incorrectos.FALSE";
		}

		$text = $this->input->post('pais_buscar');
		$this->db->like($this->cmp_pais_nombre, $text);
		$query = $this->db->get($this->tabla_pais);

		return $query->result();
	}

	function obt_x_id($id)
	{
		$query = $this->db->get_where($this->tabla_pais, array($this->cmp_pais_id => $id), 16, 0);
		return $query->result();
	}
}
/* Fin de archivo pais_model.php */
/* Ubicacion: ./motor/models/pais_model.php */

?>
