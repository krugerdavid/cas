<?php

$attributes = array('class' => 'form-item', 'id' => 'usr-form');
$form_action = 'reportes/filtrar_aporte';

//variables para los input
$usr_nombre    	= array('name' => 'usr_nombres', 'id' => 'usr_nombre', 'class' => 'col-description', 'maxlength' => '50' );
$usr_apellido  	= array('name' => 'usr_apellidos', 'id' => 'usr_apellido', 'class' => 'col-description', 'maxlength' => '50');
$usr_doc_num   	= array('name' => 'usr_doc_num', 'id' => 'usr_doc_num', 'class' => 'col-short-descrip', 'maxlength' => '15');
$apr_fechaD     = array('name' => 'apr_fechaD', 'id' => 'apr_fechaD', 'class' => 'col-short-descrip', 'maxlength' => '15');
$apr_fechaH     = array('name' => 'apr_fechaH', 'id' => 'apr_fechaH', 'class' => 'col-short-descrip', 'maxlength' => '15');

//salida 
$op_salida      =  array();
$op_salida['1'] = 'Pantalla';
$op_salida['2'] =' PDF';

//tipo reporte
$tipo_reporte      =  array();
$tipo_reporte['1'] = 'Resumen';
$tipo_reporte['2'] =' Detalle';


//seleccion de comunidad
$query_cmn  = $this->Comunidad_model->obt_todos();
$op_cmn     = array();
$op_cmn['%']='N/A';
foreach ($query_cmn as $row) {
	$op_cmn[$row->cmn_id] = $row->cmn_nombre;
}

//seleccion de confesion
$query_cnf  = $this->Confesion_model->obt_todos();
$op_cnf     = array();
$op_cnf['%']='N/A';
foreach ($query_cnf as $row) {
	$op_cnf[$row->cnf_id] = $row->cnf_nombre;
}

// setear los selects
$selected_cmn     = '';
$selected_cnf     = '';
$selected_salida  = '';	
$selected_tipo    = '';	

?>

 <!-- inicio del script de validacion-->
    <script type="text/javascript">
        $(document).ready(function(){ 
			   //agregar mascaras a los campos de fecha
              $("input[id*=apr_fechaD]").mask("9999-99-99");
			  $("input[id*=apr_fechaH]").mask("9999-99-99");
			   
			  
        });//fin de function ready
    </script> <!-- fin del script de validacion-->

<div>

 
   <!-- el formulario de datos -->
    <?php echo form_open($form_action,$attributes); ?>
	
	<script language="javascript" src="<?php echo base_url()?>js/jreportes.js"></script>

    <!-- panel de mensajes -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
    <?php endif ;?>

    <!-- El titulo de la pantalla-->
    <div class="admin-list">
        <div class="header">
			<img id="img-personales" class="" style="border: 0pt none ;" src="<?php echo base_url()?>images/right.gif"/>
            Filtros de Aportes
            <div class="clear"></div>
        </div>
    </div>

	<div id="div-personales">
	    <!-- el formulario de filtros -->
	    <ul class="lineas">
	        <li>
	           <label for="com_nombre">Nombres </label>
				<?php echo form_input($usr_nombre); ?>
				
				<label for="com_nombre">Apellidos </label>
				<?php echo form_input($usr_apellido); ?>
	            <div class="clear"></div>
	        </li>
			
	        <li>
	          <label for="com_nombre">Num. Doc </label>
				<?php echo form_input($usr_doc_num); ?>
	          
				<label for="com_nombre">Comunidad </label>
				<?php echo form_dropdown("cmn", $op_cmn,$selected_cmn); ?>
									
				<div class="clear"></div>
	        </li>
			
			<li>		
				<label for="com_nombre">Fecha (Desde) </label>
				<?php echo form_input($apr_fechaD); ?>
				
				<label for="com_nombre">Fecha (Hasta) </label>
				<?php echo form_input($apr_fechaH); ?>
				
				<div class="clear"></div>
			</li>		
			
			<li>	
				<label for="com_nombre">Confesion </label>
				<?php echo form_dropdown("cnf", $op_cnf,$selected_cnf); ?>
				
				<div class="clear"></div>
			</li>		
			
			<li>
				  <!-- linea-->
				<hr></hr>
			</li>	
			
			<div style="top-margin:15px; padding-right:320px; padding-left:10px">
				<li>								
					<label for="com_nombre">Salida </label>
					<?php echo form_dropdown("salida", $op_salida, $selected_salida); ?>
					
					
					<label for="com_nombre">Tipo Reporte</label>
					<?php echo form_dropdown("tipo_reporte", $tipo_reporte, $selected_tipo); ?>
				
					
					<button name="btn_Filtrar" style="float:right" type="submit">Listar</button> 
					
					<div class="clear"></div>	
					
				</li>								
			</div>
	        
	    </ul>
	</div>	
        <?php echo form_close(); ?>

</div>
<div class="clear"></div>

<?php
/* Fin de archivo reporte_aportes_filtros.php */
/* Ubicacion: ./motor/views/reportes/reporte_aportes_filtros.php */
?>



