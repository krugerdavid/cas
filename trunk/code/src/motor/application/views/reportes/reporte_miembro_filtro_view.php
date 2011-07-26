<?php

$attributes = array('class' => 'form-item', 'id' => 'usr-form');
$form_action = 'reportes/filtrar_miembro/';

//variables para los input
$usr_nombre    	= array('name' => 'usr_nombres', 'id' => 'usr_nombre', 'class' => 'col-description', 'maxlength' => '50' );
$usr_apellido  	= array('name' => 'usr_apellidos', 'id' => 'usr_apellido', 'class' => 'col-description', 'maxlength' => '50');
$usr_email     	= array('name' => 'usr_email','id' => 'usr_email','class' => 'usr_mail','maxlength' => '30' );
$usr_doc_num   	= array('name' => 'usr_doc_num', 'id' => 'usr_doc_num', 'class' => 'col-short-descrip', 'maxlength' => '15');
$usr_domicilio 	= array('name' => 'usr_domicilio', 'id' => 'usr_domicilio', 'class' => 'col-description', 'maxlength' => '50');
$usr_telefono  	= array('name' => 'usr_telefono', 'id' => 'usr_telefono', 'class' => 'col-short-descrip', 'maxlength' => '15');
$usr_fecha_nacD = array('name' => 'usr_fecha_nacD', 'id' => 'usr_fecha_nacD', 'class' => 'col-short-descrip', 'maxlength' => '15');
$usr_fecha_nacH = array('name' => 'usr_fecha_nacH', 'id' => 'usr_fecha_nacH', 'class' => 'col-short-descrip', 'maxlength' => '15');



//casado
$op_casado = array();
$op_casado['%']  ='N/A';
$op_casado['S']  ='SI';
$op_casado['N']  ='NO';


//bautizmo
$op_bautizado = array();
$op_bautizado['%']  ='N/A';
$op_bautizado['S']  ='SI';
$op_bautizado['N']  ='NO';


//confirmarcion
$op_confirmado = array();
$op_confirmado['%']  ='N/A';
$op_confirmado['S']  ='SI';
$op_confirmado['N']  ='NO';

//sexo
$op_sexo      = array();
$op_sexo['%'] = 'N/A';
$op_sexo['M'] = 'M';
$op_sexo['F'] = 'F';

//sexo
$op_sexo      = array();
$op_sexo['%'] = 'N/A';
$op_sexo['M'] = 'M';
$op_sexo['F'] = 'F';

//fallecido
$op_fallecido     =  array();
$op_fallecido[''] = 'N/A';
$op_fallecido['S'] = 'SI';
$op_fallecido['N'] = 'NO';


//salida 
$op_salida       =  array();
$op_salida['1']  = 'Pantalla';
$op_salida['2']  =' PDF';


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
$selected_cmn        = '';
$selected_cnf        = '';
$selected_sexo       = '';
$selected_confirmado = '';
$selected_bautizado  = '';	
$selected_casado     = '';	
$selected_agrupar    = '';	
$selected_salida     = '';	
$selected_fallecido  = '';	

?>

   <!-- inicio del script de validacion-->
    <script type="text/javascript">
        $(document).ready(function(){ 
			   //agregar mascaras a los campos de fecha
              $("input[id*=usr_fecha_nacD]").mask("9999-99-99");
			  $("input[id*=usr_fecha_nacH]").mask("9999-99-99");
			   
			  
        });//fin de function ready
    </script> <!-- fin del script de validacion-->

<!--comunidad panel-->
<div>

	<!-- el formulario de datos -->
    <?php echo form_open($form_action,$attributes); ?>

    <!-- ADD JAVASCRIPT FOR COMUNITY -->
        <script language="javascript" src="<?php echo base_url()?>js/jreportes.js"></script>

    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>
	
	
	 
	
	
	  <!-- El titulo de la pantalla-->
    <div class="admin-list">
        <div class="header">
			<img id="img-personales" class="" style="border: 0pt none ;" src="<?php echo base_url()?>images/right.gif"/>
             Filtros de Miembros
            <div class="clear"></div>
        </div>
    </div>

	
	   <!-- el formulario de datos -->
    <?php echo form_open($form_action,$attributes); ?>
	 
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
				
				<label for="com_nombre">Direccion </label>
				<?php echo form_input($usr_domicilio); ?>
				
				<div class="clear"></div>
			</li>			
			
			<li>			
				
				<label for="com_nombre">Telefono </label>
				<?php echo form_input($usr_telefono); ?>
							
				<label for="com_nombre">Sexo </label>
				<?php echo form_dropdown("sexo", $op_sexo,$selected_sexo); ?>
				
				<div class="clear"></div>
			</li>		
				
			<li>		
				<label for="com_nombre">Fecha Nac. (Desde) </label>
				<?php echo form_input($usr_fecha_nacD); ?>
				
				<label for="com_nombre">Fecha Nac. (Hasta) </label>
				<?php echo form_input($usr_fecha_nacH); ?>
				
				<div class="clear"></div>
			</li>		
			
			<li>		
				<label for="com_nombre">Comunidad </label>
				<?php echo form_dropdown("cmn", $op_cmn,$selected_cmn); ?>
					
				<label for="com_nombre">Confesion </label>
				<?php echo form_dropdown("cnf", $op_cnf,$selected_cnf); ?>
				
				<label for="com_nombre">Fallecido </label>
				<?php echo form_dropdown("fallecido", $op_fallecido, $selected_fallecido); ?>
				
				<div class="clear"></div>
			</li>		
					
			<li>		
				<label for="com_nombre">Bautizado </label>
				<?php echo form_dropdown("bautizado", $op_bautizado, $selected_bautizado); ?>
				
				<label for="com_nombre">Confirmado </label>
				<?php echo form_dropdown("confirmado", $op_confirmado, $selected_confirmado); ?>
							 
				<label for="com_nombre">Casado </label>
				<?php echo form_dropdown("casado", $op_casado ,$selected_casado); ?>
				<div class="clear"></div>
			</li>		
			<li>
				<hr></hr>
			</li>	
			
			<div style="top-margin:15px; padding-right:450px; padding-left:100px">
				<li>								
						<label for="com_nombre">Salida </label>
						<?php echo form_dropdown("salida", $op_salida,$selected_salida); ?>
				
					
					<button name="btn_Filtrar" style="float:right" type="submit">Listar</button> 
					
					<div class="clear"></div>	
					
				</li>								
			</div>
							
		</ul>
	
	</div>
	
	 <?php echo form_close(); ?>
	
	<div class="clear"></div>
</div>