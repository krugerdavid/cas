
<?php

// Seteo los atributos para el formulario
$attributes = array('class' => 'persona-form', 'id' => 'usr-form');
$form_action = 'miembro/conyugue_guardar';
$miembro_id = $miembro_referencia;
$conyugue_id = '';

// Seteo los valores de cada propiedad del formulario

//nombre
$lb_nombres             = '*Nombres';
$usr_nombre             = array('name' => 'usr_nombres', 'id' => 'usr_nombre', 'class' => 'usr_info', 'maxlength' => '50' );

//apellido
$lb_apellidos           = '*Apellidos';
$usr_apellido           = array('name' => 'usr_apellidos', 'id' => 'usr_apellido', 'class' => 'usr_info', 'maxlength' => '50');

//email
$lb_email               = 'Correo';
$usr_email              = array('name' => 'usr_email','id' => 'usr_email','class' => 'usr_mail','maxlength' => '30' );

//numero de documento
$lb_doc_num             = '*Nro. Documento';
$usr_doc_num           = array('name' => 'usr_doc_num', 'id' => 'usr_doc_num', 'class' => 'usr_doc_num', 'maxlength' => '10');

//casado?
$lb_casado              = '*Casado?';
$usr_casado_si       = array('name' => 'usr_casado', 'id' => 'usr_casado', 'value' => 'S', 'class' => 'casado-radio');
$usr_casado_no       = array('name' => 'usr_casado', 'id' => 'usr_casado', 'value' => 'N', 'class' => 'casado-radio', 'checked' => TRUE );

//direccion
$lb_direccion           = 'Direccion';
$usr_domicilio           = array('name' => 'usr_domic', 'id' => 'usr_domic', 'class' => 'usr_info', 'maxlength' => '50');

//telefono
$lb_telefono            = 'Telefono';
$usr_telefono           = array('name' => 'usr_tel', 'id' => 'usr_tel', 'class' => 'usr_telefono', 'maxlength' => '20');

//fecha de nacimiento
$lb_fecha_nac           = '*Fecha de Nacimiento';
$usr_fecha_nac          = array('name' => 'usr_fecha_nac', 'id' => 'usr_fecha_nac', 'class' => 'usr_nac', 'maxlength' => '10');

//lugar de nacimiento
$lb_lugar_nac           = 'Lugar de Nacimiento';
$usr_lugar_nac          = array('name' => 'usr_lugar_nac', 'id' => 'usr_lugar_nac', 'class' => 'usr_info', 'maxlength' => '50');

//bautizado?
$lb_bautizado           = 'Bautizado?';
$usr_bautizado_si       = array('name' => 'usr_bautizado', 'id' => 'usr_bautizado', 'value' => 'S', 'class' => 'bautismo-radio');
$usr_bautizado_no       = array('name' => 'usr_bautizado', 'id' => 'usr_bautizado', 'value' => 'N', 'class' => 'bautismo-radio', 'checked' => TRUE );

//fecha de bautismo
$lb_bautizado_fec       = 'Fecha Bautismo';
$usr_bautizado_fec      = array('name' => 'usr_bautizado_fec', 'id' => 'usr_bautizado_fec', 'class' => 'usr_nac', 'maxlength' => '10');

//lugar sepultado
$lb_lugar_bautizado     = 'Lugar Bautizado';
$usr_lugar_bautizado    = array('name' => 'usr_lugar_bautizado', 'id' => 'usr_lugar_bautizado', 'class' => 'usr_info', 'maxlength' => '50');

//confirmado?
$lb_confirmado          = 'Confirmado?';
$usr_confirmado_si       = array('name' => 'usr_confirmado', 'id' => 'usr_confirmado', 'value' => 'S', 'class' => 'confirmado-radio');
$usr_confirmado_no       = array('name' => 'usr_confirmado', 'id' => 'usr_confirmado', 'value' => 'N', 'class' => 'confirmado-radio', 'checked' => TRUE );

//fecha de defunsion
$lb_defunsion_fec       = 'Fecha Defunsion';
$usr_defunsion_fec      = array('name' => 'usr_defunsion_fec', 'id' => 'usr_defunsion_fec', 'class' => 'usr_nac', 'maxlength' => '10');

//lugar sepultado
$lb_lugar_sepultado     = 'Lugar Sepultado';
$usr_lugar_sepultado    = array('name' => 'usr_lugar_sepultado', 'id' => 'usr_lugar_sepultado', 'class' => 'usr_info', 'maxlength' => '50');

//observaciones
$lb_obs                 = 'Observaciones';
$usr_obs           = array('name' => 'usr_obs', 'id' => 'usr_obs', 'class' => 'usr_info', 'type' => 'textarea', 'rows' => '6', 'cols' => '50');

//sexo
$lb_usr_sexo            = '*Sexo';
$op_sexo = array('F' => 'Femenino', 'M' => 'Masculino');

//seleccion de comunidad
$lb_usr_comunidad       = '*Comunidad';
$dbres_cmn  = $this->comunidad_modelo->obt_todos();
$op_cmn     = array();
foreach ($dbres_cmn as $tablerow) {
  $op_cmn[$tablerow->cmn_id] = $tablerow->cmn_nombre;
}

//seleccion de confesion
$lb_usr_confesion       = '*Confesi&oacute;n';
$dbres_cnf  = $this->confesion_modelo->obt_todos();
$op_cnf     = array();
foreach ($dbres_cnf as $tablerow) {
  $op_cnf[$tablerow->cnf_id] = $tablerow->cnf_nombre;
}

//boton de guardar
$bt_do_crear            = 'Guardar';
$bt_crear_usuario       = array('name' => 'bt_guardar_miembro', 'id' => 'bt_guardar_miembro', 'class' => 'bt-crear');

//boton cancelar
$bt_do_cancel           = 'Cancelar';
$bt_cancel              = array('name' => 'bt_cancel', 'id' => 'bt_cancel', 'class' => 'button');

// setear los selects
$selected_cmn           = '';
$selected_sex           = '';
$selected_cnf           = '';

// Verifico si no se quieren editar datos. En caso de que
// se quiera editar cargo los datos en el fomrulario.
if($editar_form == 1)
{
    //se revisa si se tiene cargado algun valor de fecha para
    //obtener el formato correcto
    if (!empty($query->prs_fecha_nacimiento)){
        $usr_fecha_nac['value'] = date("Y-m-d", strtotime($query->prs_fecha_nacimiento));
    }

    if (!empty($query->prs_bautismo)){
        $usr_bautizado_fec['value'] = date("Y-m-d", strtotime($query->prs_bautismo));
    }

    if (!empty($query->prs_defunsion)){
       $usr_defunsion_fec['value'] = date("Y-m-d", strtotime($query->prs_defunsion));
    }

    //se cargan los demas datos del miembro
    $conyugue_id             = $query->prs_id;
    $selected_cmn           = $query->cmn_id;
    $selected_sex           = $query->prs_sexo;
    $selected_cnf           = $query->cnf_id;
    $usr_obs['value']       = $query->prs_observacion;
    $usr_lugar_sepultado['value']   = $query->prs_lugar_sepultado;
    $usr_lugar_bautizado['value']   = $query->prs_lugar_bautismo;
    $usr_lugar_nac['value']         = $query->prs_lugar_nacimiento;
    $usr_telefono['value']          = $query->prs_telefono;
    $usr_domicilio['value']         = $query->prs_direccion;
    $usr_doc_num['value']           = $query->prs_doc_num;
    $usr_apellido['value']          = $query->prs_apellidos;
    $usr_nombre['value']            = $query->prs_nombres;
    $usr_email['value']             = $query->prs_email;

    if ($query->prs_bautizado == 'S')
    {
        $usr_bautizado_si["checked"] = TRUE;
        $usr_bautizado_no["checked"] = FALSE;
    }

    if ($query->prs_confirmado == 'S')
    {
        $usr_confirmado_si["checked"] = TRUE;
        $usr_confirmado_no["checked"] = FALSE;
    }

    if ($query->prs_casado == 'S')
    {
        $usr_casado_si["checked"] = TRUE;
        $usr_casado_no["checked"] = FALSE;
    }
}

?>

<!-- se llama a la funcion de jquery ui que crea los tabs a partir de los div -->
<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
</script>

<!-- columna derecha -->
<div class="right_column">

    <!-- se agrega el estilo para marcar los campos incorrectos -->
    <style>
        label.error {color: red; margin-top: 2px;  margin-bottom: 2px; padding-left: 155px; text-align: left;
                    clear: both; width: 350px;}
    </style>

    <!-- se agrega el javascripta para las validaciones del formulario -->
    <script language="javascript" src="<?php echo base_url()?>js/jmiembro.js"></script>

    <!-- panel de mensajes -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
    <?php endif ;?>

    <!-- El titulo de la pantalla-->
    <div class="sc-hdr">
        <h2 class="mmb-cny"><?php echo $titulo_form; ?></h2>
        <div class="clear"></div>
    </div>

    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <!-- el formulario de datos -->
    <?php echo form_open($form_action,$attributes); ?>
        <?php echo form_hidden('miembro_id', $miembro_id); ?>
        <?php echo form_hidden('conyugue_id', $conyugue_id); ?>

        <div id="tabs">

        <ul>
            <li><a href="#div-personales">Datos Personales</a></li>
            <li><a href="#div-ubicacion">Datos de Ubicacion</a></li>
            <li><a href="#div-bautismo">Bautismo y Defunsion</a></li>
            <li><a href="#div-observaciones">Observaciones</a></li>
        </ul>
        
        <div id="div-personales">
            <ul class="lineas">
            <li>
                <?php echo form_label($lb_nombres); ?>
                <?php echo form_input($usr_nombre); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_apellidos); ?>
                <?php echo form_input($usr_apellido); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_doc_num); ?>
                <?php echo form_input($usr_doc_num); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_fecha_nac, 'usr_fecha_nac', ''); ?>
                <?php echo form_input($usr_fecha_nac); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_lugar_nac); ?>
                <?php echo form_input($usr_lugar_nac); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_casado); ?>
                <?php echo form_radio($usr_casado_si); ?>
                <span class="casado-opciones">SI</span>
                <?php echo form_radio($usr_casado_no); ?>
                <span class="casado-opciones">NO</span>
                <div class="clear"></div>
            </li>
             <li>
                <?php echo form_label($lb_usr_sexo); ?>
                <?php echo form_dropdown("sexo", $op_sexo,$selected_sex); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_usr_confesion); ?>
                <?php echo form_dropdown("cnf", $op_cnf,$selected_cnf); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_usr_comunidad); ?>
                <?php echo form_dropdown("cmn", $op_cmn,$selected_cmn); ?>
                <div class="clear"></div>
            </li>
            </ul>

        </div>
        
        <div id="div-ubicacion">
            <ul class="lineas">
            <li>
                <?php echo form_label($lb_direccion); ?>
                <?php echo form_input($usr_domicilio); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_telefono); ?>
                <?php echo form_input($usr_telefono); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_email); ?>
                <?php echo form_input($usr_email); ?>
                <div class="clear"></div>
            </li>
            </ul>
        </div>
        <div id="div-bautismo">
             <ul class="lineas">
            <li>
                <?php echo form_label($lb_bautizado); ?>
                <?php echo form_radio($usr_bautizado_si); ?>
                <span class="bautismo-opciones">SI</span>
                <?php echo form_radio($usr_bautizado_no); ?>
                <span class="bautismo-opciones">NO</span>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_bautizado_fec); ?>
                <?php echo form_input($usr_bautizado_fec); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_lugar_bautizado); ?>
                <?php echo form_input($usr_lugar_bautizado); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_confirmado); ?>
                <?php echo form_radio($usr_confirmado_si); ?>
                <span class="confirmado-opciones">SI</span>
                <?php echo form_radio($usr_confirmado_no); ?>
                <span class="confirmado-opciones">NO</span>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_defunsion_fec); ?>
                <?php echo form_input($usr_defunsion_fec); ?>
                <div class="clear"></div>
            </li>
            <li>
                <?php echo form_label($lb_lugar_sepultado); ?>
                <?php echo form_input($usr_lugar_sepultado); ?>
                <div class="clear"></div>
            </li>
            </ul>
        </div>
        
        <div id="div-observaciones">
            <ul class="lineas">
                <li>
                    <?php echo form_label($lb_obs); ?>
                    <?php echo form_textarea($usr_obs); ?>
                    <div class="clear"></div>
                </li>
            </ul>
        </div>
        </div>
        <div class="button-div">
            <ul class="lineas">
                <li>
                    <?php echo form_submit($bt_crear_usuario, $bt_do_crear);?>
                    <?php echo form_reset($bt_cancel, $bt_do_cancel);?>
                    <div class="clear"></div>
                </li>
            </ul>
        </div>
    <?php echo form_close(); ?>

</div>
<div class="clear"></div>

<?php
/* Fin de archivo conyugue_agregar.php */
/* Ubicacion: ./motor/views/miembro/conyugue_agregar.php */
?>
