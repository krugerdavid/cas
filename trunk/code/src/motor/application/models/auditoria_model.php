<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Auditoria_model extends Model {

    //definir los nombres de las tablas a utilizar para evitar problemas
    //si se cambia el modelo de datos
    var $tabla_auditoria  = 'vista_auditoria';
    var $cmp_usr = 'usr_nombre';
    var $cmp_adt_hora_trans = 'adt_hora_trans';
    var $cmp_adt_nombre_tbl = 'adt_nombre_tabla';
    var $cmp_adt_nombre_col = 'adt_nombre_col';
    var $cmp_adt_evento = 'adt_evento';
    var $cmp_adt_valor_ant = 'adt_valor_ant';
    var $cmp_adt_valor_nuevo = 'adt_valor_nuevo';
    function Auditoria_model()
    {
        // Call the Model constructor
        parent::Model();
    }

    function obt_todos()
    {
        $query = $this->db->get($this->tabla_auditoria);
        return $query->result();
    }

    function obtener_logs($items_x_page, $limite, $sort = '')
    {
        $this->db->select('*');
        $this->db->from('vista_auditoria');
        $this->db->limit($items_x_page, $limite);
        if(!empty($sort)){
            $result = explode('.', $sort);
            $this->db->order_by($result[0], $result[1]);
        }else{
            $this->db->order_by("adt_hora_trans", "desc");
        }
        $query = $this->db->get();
        return $query->result();
    }
    function total_logs()
    {
        return $this->db->count_all('vista_auditoria');
    }

	function buscar()
	{
		if ($this->input->post('adt_buscar')== NULL )
		{
			return "Parametros incorrectos.FALSE";
		}

		$text = $this->input->post('adt_buscar');
		$this->db->like($this->cmp_usr, $text);
//		$this->db->like($this->adt_hora_trans, $text);
//		$this->db->like($this->adt_nombre_tbl, $text);
		$this->db->like($this->cmp_adt_nombre_col, $text);
//		$this->db->like($this->adt_evento, $text);
//		$this->db->like($this->adt_valor_ant, $text);
//		$this->db->like($this->adt_valor_nuevo, $text);
		$query = $this->db->get($this->tabla_auditoria);

		return $query->result();
	}


}
/* Fin de archivo auditoria_model.php */
/* Ubicacion: ./motor/models/auditoria_model.php */

?>
