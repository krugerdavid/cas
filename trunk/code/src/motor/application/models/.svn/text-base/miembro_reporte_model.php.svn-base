<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/

class Miembro_reporte_model extends Model {

    var $title   			    = '';
    var $content			    = '';
    var $date   			    = '';
	var $sql    		   	    = '';
	
	//constantes
	var $HIJO                   = 100;
	var $CONYUGUE               = 200;
	var $OTROS                  = 300;

    function Miembro_reporte_model()
    {
        // Call the Model constructor
        parent::Model();
    }

	//funcion que me retorna todos los miembros con sus datos
    function obtener_todos(){
	    $sql = 'select m.mmb_id as id, p.prs_nombres as nombres, p.prs_apellidos as apellidos, p.prs_doc_num as num_doc,'.
		'p.prs_direccion as direccion, p.prs_telefono as telefono, p.prs_sexo as sexo, p.prs_fecha_nacimiento as fecha_nac,'.
		'com.cmn_nombre as comunidad, conf.cnf_nombre as confesion '. 
		'from miembro m'. 
		' inner join persona p'.
		' on m.mmb_id = p.prs_id'. 
		' inner join comunidad com'. 
		' on com.cmn_id = p.cmn_id '.
		' inner join confesion conf'.
		' on conf.cnf_id = p.cnf_id ';
		
        $query = $this->db->query($sql);
		
		//si la consulta está vacia retornar valor VACIO

        if (count($query->result()) >= 1)
        {
			return $query->result();
        }else
        {
            return 'VACIO';
        }

    }
	
	 //funcion que me retorna los datos basicos de un miembro especifico
	 function obtener_miembro($id){
	    $sql = 'select m.mmb_id as id, p.prs_nombres as nombres, p.prs_apellidos as apellidos, p.prs_doc_num as num_doc,'.
		'p.prs_direccion as direccion, p.prs_telefono as telefono, p.prs_sexo as sexo, p.prs_fecha_nacimiento as fecha_nac,'.
		'p.prs_bautizado as bautizado, p.prs_confirmado as confirmado, p.prs_casado as casado, '. 
		'com.cmn_nombre as comunidad, conf.cnf_nombre as confesion '. 
		'from miembro m'. 
		' inner join persona p'.
		' on m.mmb_id = p.prs_id'. 
		' inner join comunidad com'. 
		' on com.cmn_id = p.cmn_id '.
		' inner join confesion conf'.
		' on conf.cnf_id = p.cnf_id '.
		  'where m.mmb_id ='. $id;
		
        $query = $this->db->query($sql);
		        
	  //si la consulta está vacia retornar valor VACIO				
				
		if (count($query->result()) == 1)
        { 
			return $query->result(); 
        }else
        {
            return 'VACIO';
        }

    }
	
	
	//funcion que me retorna todos los hijos de un miembro especifico
	function obtener_hijos($id){
	    
		 $sql = 'select prs_id as codigo, prs_nombres as nombres, prs_apellidos as apellidos, prs_doc_num as num_doc '.
		      'from persona p '.
		      'where p.prs_id in( '.
		      'select p_relacion.prs_id '.
		      'from persona p_miembro '.
		      'inner JOIN persona_relacion p_relacion '.
		      'on  p_miembro.prs_id = p_relacion.mmb_id '.
		      'and p_miembro.prs_id ='. $id.
		      ' where p_relacion.rlc_id ='.$this->HIJO.')';
	 
		$query = $this->db->query($sql);
		
		//si la consulta está vacia retornar valor VACIO	
		
       if (count($query->result()) >= 1){
			return $query->result();
        } else{
            return 'VACIO';
        }
		
	}
	
	//funcion que me retorna el conyugue de un miembro especifico
	function obtener_conyugue($id){
	 $sql = 'select prs_id as codigo, prs_nombres as nombres, prs_apellidos as apellidos, prs_doc_num as num_doc '.
		      'from persona p '.
		      'where p.prs_id in( '.
		      'select p_relacion.prs_id '.
		      'from persona p_miembro '.
		      'inner JOIN persona_relacion p_relacion '.
		      'on  p_miembro.prs_id = p_relacion.mmb_id '.
		      'and p_miembro.prs_id ='. $id.
		      ' where p_relacion.rlc_id ='.$this->CONYUGUE.')';
	 
		$query = $this->db->query($sql);
	
		//si la consulta está vacia retornar valor VACIO			
		if (count($query->result()) == 1)
        {
			return $query->result();
        }else
        {
            return 'VACIO';
        }
	}
	
	//funcion que me retorna los datos de las personas relacionadas a un miembro especifico
	function obtener_otros($id){
	    
	    $sql = 'select prs_id as codigo, prs_nombres as nombres, prs_apellidos as apellidos, prs_doc_num as num_doc '.
		      'from persona p '.
		      'where p.prs_id in( '.
		      'select p_relacion.prs_id '.
		      'from persona p_miembro '.
		      'inner JOIN persona_relacion p_relacion '.
		      'on  p_miembro.prs_id = p_relacion.mmb_id '.
		      'and p_miembro.prs_id ='. $id.
		      ' where p_relacion.rlc_id ='.$this->OTROS.')';
	 
		$query = $this->db->query($sql);
		
		if (count($query->result()) >= 1)
        {
			return $query->result();
        }else
        {
            return 'VACIO';
        }
		
		
	}	
	
	//funcion que retorna los miembros requeridos por el fitlro de aportes
	function obtener_miembros_aportes($nombres, $apellidos, $num_doc, $id_cmn, $id_cnf, $fechaD, $fechaH){
	    
	   //armar sentencia sql
		$sql = 'select m.mmb_id, p.prs_nombres as nombres, p.prs_apellidos as apellidos, p.prs_doc_num as num_doc,'.
			' ap.apr_fecha, ap.apr_monto,'.
			' com.cmn_nombre as comunidad, conf.cnf_nombre as confesion '. 
			' from miembro m'. 
			' inner join persona p'.
			' on m.mmb_id = p.prs_id'. 
			' inner join comunidad com'. 
			' on com.cmn_id = p.cmn_id '.
			' inner join confesion conf'.
			' on conf.cnf_id = p.cnf_id '.
			' inner join aporte ap'.
			' on m.mmb_id = ap.mmb_id '.
			' where p.prs_nombres like \'%'. $nombres. '%\' '.
			' and p.prs_apellidos like \'%'. $apellidos. '%\' '.
			' and p.prs_doc_num like \'%'. $num_doc. '%\' '.
			' and p.cmn_id like \'%'. $id_cmn. '%\' '.
			' and p.cnf_id like \'%'. $id_cnf. '%\' '.
			' and ap.apr_fecha >= \''. $fechaD. '\' ';
			
			//concatenar fecha hasta en caso que no esté vacio
			//obs: se concatena de esta manero porque el comodin % no funciona con el signo <
			if (!empty($fechaH)){
				$sql = $sql.' and ap.apr_fecha <= \''. $fechaH. ' 99:99:99 \' ';
			}
			
			$sql = $sql.' order by m.mmb_id, ap.apr_fecha';
			
		
	 
		$query = $this->db->query($sql);
		
		if (count($query->result()) >= 1)
        {
			return $query->result();
        }else
        {
            return '';
        }
	}	
	
	function obtener_miembros_aportes_resumen($nombres, $apellidos, $num_doc, $id_cmn, $id_cnf, $fechaD, $fechaH){
		//armar sentencia sql
		$sql = 'select m.mmb_id, p.prs_nombres as nombres, p.prs_apellidos as apellidos, p.prs_doc_num as num_doc,'.
			' ap.apr_fecha, sum(ap.apr_monto) as monto,'.
			' com.cmn_nombre as comunidad, conf.cnf_nombre as confesion '. 
			' from miembro m'. 
			' inner join persona p'.
			' on m.mmb_id = p.prs_id'. 
			' inner join comunidad com'. 
			' on com.cmn_id = p.cmn_id '.
			' inner join confesion conf'.
			' on conf.cnf_id = p.cnf_id '.
			' inner join aporte ap'.
			' on m.mmb_id = ap.mmb_id '.
			' where p.prs_nombres like \'%'. $nombres. '%\' '.
			' and p.prs_apellidos like \'%'. $apellidos. '%\' '.
			' and p.prs_doc_num like \'%'. $num_doc. '%\' '.
			' and p.cmn_id like \'%'. $id_cmn. '%\' '.
			' and p.cnf_id like \'%'. $id_cnf. '%\' '.
			' and ap.apr_fecha >= \''. $fechaD. '\' ';
			
			//concatenar fecha hasta en caso que no esté vacio
			//obs: se concatena de esta manero porque el comodin % no funciona con el signo <
			if (!empty($fechaH)){
				$sql = $sql.' and ap.apr_fecha <= \''. $fechaH. ' 99:99:99 \' ';
			}
			
		//	$sql = $sql.' order by m.mmb_id, ap.apr_fecha';
			
		$sql = $sql.' group by m.mmb_id';	
			
		
	 
		$query = $this->db->query($sql);
		
		if (count($query->result()) >= 1)
        {
			return $query->result();
        }else
        {
            return '';
        }
	}	
	
	

		
	//funcion que retorna los aportes de un miembro
	function obtener_aportes($id, $fechaD, $fechaH){
  	
	    $this->db->select('apr_monto as aporte, apr_fecha as fecha');
        $this->db->from('aporte');
		$this->db->where('mmb_id', $id);
		if (!empty($fechaD)){
			$this->db->where('apr_fecha >=', $fechaD);
		}	
		if (!empty($fechaH)){
			$this->db->where('apr_fecha <=', $fechaH. '99:99:99');
		}	
        $query = $this->db->get();
		
		if (count($query->result()) >= 1)
        {
			return $query->result();
        }else
        {
            return '';
        }
		
		
	}	

		
	//funcion que retorna una consulta con los datos de filtro
	function filtrar_miembros($nombres, $apellidos, $num_doc, $domicilio, $telefono, $sexo, $fechaD, $fechaH, 
	$id_cmn, $id_cnf, $bautizado, $confirmado, $casado, $fallecido){
		 
		//armar sentencia sql
		$sql = 'select m.mmb_id as id, p.prs_nombres as nombres, p.prs_apellidos as apellidos, p.prs_doc_num as num_doc,'.
			'p.prs_direccion as direccion, p.prs_telefono as telefono, p.prs_sexo as sexo, p.prs_fecha_nacimiento as fecha_nac,'.
			'com.cmn_nombre as comunidad, conf.cnf_nombre as confesion '. 
			'from miembro m'. 
			' inner join persona p'.
			' on m.mmb_id = p.prs_id'. 
			' inner join comunidad com'. 
			' on com.cmn_id = p.cmn_id '.
			' inner join confesion conf'.
			' on conf.cnf_id = p.cnf_id '.
			' where p.prs_nombres like \'%'. $nombres. '%\' '.
			' and p.prs_apellidos like \'%'. $apellidos. '%\' '.
			' and p.prs_doc_num like \'%'. $num_doc. '%\' '.
			' and p.prs_direccion like \'%'. $domicilio. '%\' '.
			' and p.prs_telefono like \'%'. $telefono. '%\' '.
			' and p.prs_sexo like \'%'. $sexo. '%\' '.
			 ' and p.prs_fecha_nacimiento >= \''. $fechaD. '\' '.
			' and p.cmn_id like \'%'. $id_cmn. '%\' '.
			' and p.cnf_id like \'%'. $id_cnf. '%\' '.
			' and p.prs_bautizado like \'%'. $bautizado. '%\' '.
			' and p.prs_confirmado like \'%'. $confirmado. '%\' '.
			' and p.prs_casado like \'%'. $casado. '%\' ';
					
			
			//concatenar fecha hasta en caso que no esté vacio
			//obs: se concatena de esta manero porque el comodin % no funciona con el signo <
			if (!empty($fechaH)){
				$sql = $sql.' and p.prs_fecha_nacimiento <= \''. $fechaH. ' 99:99:99 \' ';
			}
			
			//concatenar filtro de fallecidos
			if ($fallecido=='S'){
				$sql = $sql.' and p.prs_defunsion is null';
			}
			
			//concatenar filtro de no fallecidos
			if ($fallecido=='S'){
				$sql = $sql.' and p.prs_defunsion is not null';
			}
			
				
        $query = $this->db->query($sql);
		
		//si la consulta está vacia retornar valor VACIO

        if (count($query->result()) >= 1)
        {
			return $query->result();
        }else
        {
            return '';
        }


	}	
}

?>