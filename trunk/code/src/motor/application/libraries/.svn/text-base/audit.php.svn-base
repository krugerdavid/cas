<?php


class Audit{

    //ATRIBUTOS A SER ALMANCENADOS EN LA TABLA DE AUDITORIA

    //tiempo UNIX de la transaccion que se esta loggeando o de un transaccion auditada
    private $actual_hora;

    //usuario que actualmente esta siendo "auditado"
    private $actual_usr;

    private $CI;
    private $last_id;

    function Audit()
    {
        $this->CI =& get_instance();
        $this->CI->load->database();
    }


    /*
        begin_audit() - inicia una transaccion de auditoria. Si es que se crearon los triggers de 
        auditoria previamente, las sentencias encapsulas entre begin_audit() y end_audit()deberian
        disparar sus triggers y guardar los datos de auditoria.
        
        Params : 
        ========
        
        $db => identificador de base de datos
        $user_id => id de us}uario (se puede obtener de $_SESSION['USER_NAME'] por ejemplo)
    */

    function begin_audit( $user_id ){
        //inicio de transaccion
        $this->CI->db->trans_start();
        $this->actual_usr = $user_id;
        $this->CI->db->query("BEGIN");

        $this->last_id = $this->CI->db->insert_id();


    }
    /*
        end_audit() - finaliza una transaccion de auditoria.

        Descripcion
        ===========

        Actualiza la tabla de auditoria con los datos
        $this->actual_hilo_id
        $this->actual_hora
        $this->actual_usr
    */

    function end_audit(){
        $end_qry = "update auditoria set ".
                        "usr_id = "."'".$this->actual_usr."', ".
                        "adt_hora_trans = NOW()";
        //echo $end_qry."<br>";
        $end_qry =$end_qry."where usr_id is NULL";
        $this->CI->db->query($end_qry);
        $this->CI->db->trans_commit();
        $this->CI->db->trans_complete();
    }
}

?>
