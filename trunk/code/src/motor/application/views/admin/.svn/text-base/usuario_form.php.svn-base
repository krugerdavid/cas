<?php

// Seteo los atributos para el formulario
$attributes     = array('class' => 'form-item', 'id' => 'usr-form');
$hidden         = '';
$form_action    = 'admin/do_agregar_usuario';

// Seteo los valores de cada label del formulario
$lb_nombres             = '* Nombres';
$lb_apellidos           = '* Apellidos';
$lb_doc_num             = '* Nro. Documento';
$lb_email               = 'Correo';
$lb_nombre_usuario      = '* Nombre de Usuario';
$lb_password            = '* Contrase&ntilde;a';
$lb_password_confirm    = '* Confirmar Contrase&ntilde;a';
$lb_fecha_nac           = '* Fecha de Nacimiento';
$lb_lugar_nac           = 'Lugar de Nacimiento';
$lb_casado              = '*Casado?';
$lb_usr_sexo            = '* Sexo';
$lb_usr_rol             = '* Rol';
$lb_usr_confesion       = '* Confesi&oacute;n';
$lb_usr_comunidad       = '* Comunidad';
$bt_do_crear            = 'Crear Usuario';
$bt_do_cancel           = 'Cancelar';

// setear los selects
$selected_cmn           = '';
$selected_sex           = '';
$selected_cnf           = '';
$selected_rol           = '';

// Seteo las propiedades de cada input del formulario
$usr_nombre             = array('name' => 'usr_nombres', 'id' => 'usr_nombres', 'maxlength' => '50', 'size' => '50' );
$usr_apellido           = array('name' => 'usr_apellidos', 'id' => 'usr_apellidos', 'maxlength' => '50', 'size' => '50');
$usr_doc_num            = array('name' => 'usr_doc_num', 'id' => 'usr_doc_num', 'maxlength' => '10', 'size' => '10');
$usr_email              = array('name' => 'usr_email','id' => 'usr_email', 'maxlength' => '30', 'size' => '30' );
$usr_nombre_usuario     = array('name' => 'usr_nombre_usuario','id' => 'usr_nombre_usuario','maxlength' => '30', 'size' => '30' );
$usr_password           = array('name' => 'usr_password','id' => 'usr_password','maxlength' => '30', 'size' => '30' );
$usr_password_confirm   = array('name' => 'usr_password_confirm', 'id' => 'usr_password_confirm', 'maxlength' => '30', 'size' => '30', 'minlength' => '6' );
$usr_fecha_nac          = array('name' => 'usr_fecha_nac', 'id' => 'usr_fecha_nac', 'maxlength' => '10', 'size' => '10');
$usr_lugar_nac          = array('name' => 'usr_lugar_nac', 'id' => 'usr_lugar_nac', 'maxlength' => '50', 'size' => '50');
$usr_casado_si          = array('name' => 'usr_casado', 'id' => 'usr_casado', 'value' => 'S', 'class' => 'casado-radio');
$usr_casado_no          = array('name' => 'usr_casado', 'id' => 'usr_casado', 'value' => 'N', 'class' => 'casado-radio', 'checked' => 'checked');
$bt_crear_usuario       = array('name' => 'bt_crear_usuario', 'id' => 'bt_crear_usuario', 'class' => 'bt-crear');
$bt_cancel              = array('name' => 'bt_cancel', 'id' => 'bt_cancel', 'class' => 'button');


// Verifico si no se quieren editar datos.
if(!empty($editar_form))
{
    if($editar_form == 1){

        $form_action = 'admin/do_editar_usuario';
        $bt_do_crear = 'Guardar Cambios';
        $bt_do_cancel = 'Deshacer Cambios';
        
        $usr_nombre['value'] = $info_usuario->prs_nombres;
        $usr_apellido['value'] = $info_usuario->prs_apellidos;
        $usr_email['value'] = $info_usuario->prs_email;
        $usr_nombre_usuario['value'] = $info_usuario->usr_nombre;
        $usr_doc_num['value'] = $info_usuario->prs_doc_num;

        if (!empty($info_usuario->prs_fecha_nacimiento)){
            $usr_fecha_nac['value'] = date("Y-m-d", strtotime($info_usuario->prs_fecha_nacimiento));
        }

        $usr_lugar_nac['value'] = $info_usuario->prs_lugar_nacimiento;

        if ($info_usuario->prs_casado == 'S')
        {
            $usr_casado_si["checked"] = TRUE;
            $usr_casado_no["checked"] = FALSE;
        }

        $lb_password            = 'Nueva Contrase&ntilde;a';
        $lb_password_confirm    = 'Confirmar Contrase&ntilde;a';

        $selected_cmn = $info_usuario->cmn_id;
        $selected_sex = $info_usuario->prs_sexo;
        $selected_cnf = $info_usuario->cnf_id;
        $selected_rol = $info_usuario->rol_id;

        $hidden = array('usr_id' => $info_usuario->usr_id, 'prs_id' => $info_usuario->prs_id );
        
    }
}

// Obtengo todos los roles del sistema
$dbres      = $this->usuario_modelo->obtener_roles('');
$op_roles   = array();
foreach ($dbres as $tablerow) {
  $op_roles[$tablerow->rol_id] = $tablerow->rol_nombre;
}

// Seteo las opciones de Sexualidad
$op_sexo = array('F' => 'Femenino', 'M' => 'Masculino');

// Obtengo todos los roles del sistema
$dbres_cmn  = $this->comunidad_modelo->obt_todos();
$op_cmn     = array();
foreach ($dbres_cmn as $tablerow) {
  $op_cmn[$tablerow->cmn_id] = $tablerow->cmn_nombre;
}

// Obtengo todos los roles del sistema
$dbres_cnf  = $this->confesion_modelo->obt_todos();
$op_cnf     = array();
foreach ($dbres_cnf as $tablerow) {
  $op_cnf[$tablerow->cnf_id] = $tablerow->cnf_nombre;
}


?>

<!-- right column -->
<div class="right_column">

    <!-- ADD JAVASCRIPT FOR COMUNITY -->
    <script language="javascript" src="<?php echo base_url()?>js/jusuario.js"></script>


    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
    <?php endif ;?>

    <div class="sc-hdr">
        <h2 class="usr-add"><?php echo $titulo_formulario; ?></h2>
        <div class="clear"></div>
    </div>
    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <?php echo validation_errors(); ?>
    <?php echo form_open($form_action,$attributes,$hidden); ?>
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
            <label id="documento_repetido" name="documento_repetido" class="error">El numero de documento ingresado ya existe. Favor verificar.</label>
            <div class="clear"></div>
        </li>
        <li>
            <?php echo form_label($lb_email); ?>
            <?php echo form_input($usr_email); ?>
            <div class="clear"></div>
        </li>
        <li>
            <?php echo form_label($lb_nombre_usuario); ?>
            <?php echo form_input($usr_nombre_usuario); ?>
            <div class="clear"></div>
        </li>

        <?php if(!empty($editar_form)) { if($editar_form == 1){ ?>
        <p class="nuevo-pass">Si no desea modificar su contraseña, no rellene los campos correspondientes.</p>
        <?php }}; ?>

        <li>
            <?php echo form_label($lb_password); ?>
            <?php echo form_password($usr_password)?>
            <div class="clear"></div>
        </li>

        <li>
            <?php echo form_label($lb_password_confirm); ?>
            <?php echo form_password($usr_password_confirm)?>
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
            <?php echo form_label($lb_usr_rol); ?>
            <?php echo form_dropdown("rol", $op_roles,$selected_rol); ?>
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
        <hr />
        <li>
            <?php echo form_submit($bt_crear_usuario, $bt_do_crear);?>
            <?php echo form_reset($bt_cancel, $bt_do_cancel);?>
            <div class="clear"></div>
        </li>
    </ul>
    <?php echo form_close(); ?>

    <script type="text/javascript">
        $('#usr_nombres').alphanumeric({ichars:'.,1234567890'});
        $('#usr_apellidos').alphanumeric({ichars:'.,1234567890'});
        $('#usr_fecha_nac').numeric({allow:"-"});
    </script>
    
</div>
<div class="clear"></div>


