<?php

class Relacion_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_relacion     = 'tipo_relacion';
    var $cmp_rlc_id         = 'rlc_id';
    var $cmp_rlc_nombre     = 'rlc_tipo';

    function Relacion_model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function obt_todos($limite)
    {
        $query = $this->db->get($this->tabla_relacion,$limite);
        return $query->result();
    }

    function insertar()
    {
		if ($this->input->post('rlc_nombre') != NULL)
		{
			$data = array($this->cmp_rlc_nombre => $this->input->post('rlc_nombre'));

			$this->db->insert($this->tabla_relacion, $data);

			return "Se ha guardado el tipo de relacion.TRUE";
		}else{
			return "Parametros incorrectos.FALSE";
		}
    }

	function modificar()
	{
		if ($this->input->post('rlc_codigo')!= NULL &&
			$this->input->post('rlc_nombre') != NULL)
		{
			$id = $this->input->post('rlc_codigo');

			$query = $this->db->get_where($this->tabla_relacion, array($this->cmp_rlc_id => $id), 0, 100);

			if ($query->num_rows <> 1)
			{
				$data = array(
					$this->cmp_rlc_nombre => $this->input->post('rlc_nombre'));

				$this->db->where($this->cmp_rlc_id, $id);
				$this->db->update($this->tabla_relacion, $data);
				return "Se ha modificado con exito el tipo de relacion.TRUE";
			}else
			{
				return "El codigo de tipo de relacion no es correcto.FALSE";
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
			$query = $this->db->get_where($this->tabla_relacion, array($this->cmp_rlc_id => $id), 0, 100);

			//si existe entonces se elimina si no, se envia en mensaje de error
			if ($query->num_rows <> 1)
			{
				$this->db->delete($this->tabla_relacion, array($this->cmp_rlc_id => $id));
				return "Se ha eliminado el tipo de relacion.TRUE";
			}else
			{
				return "El codigo de tipo de relacion no es correcto.FALSE";
			}
		}else
		{
			return "Parametros incorrectos.FALSE";
		}
	}

	function buscar()
	{
		if ($this->input->post('rlc_buscar')== NULL )
		{
			return "Parametros incorrectos.FALSE";
		}

		$text = $this->input->post('rlc_buscar');
		$this->db->like($this->cmp_rlc_nombre, $text);
		$query = $this->db->get($this-> tabla_relacion);

		return $query->result();
	}

	function obt_relacion_x_id($id)
	{
		$query = $this->db->get_where($this->tabla_relacion, array($this->cmp_rlc_id => $id), 16, 0);
		return $query->result();
	}
}
/* Fin de archivo relacion_model.php */
/* Ubicacion: ./motor/models/relacion_model.php */

?>