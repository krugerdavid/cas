<?php
//seleccion de comunidad
$selected_cmn = '';
$com_codigo = '';

$dbres_cmn  = $this->Comunidad_model->obtener_departamentos();
$op_cmn     = array();
foreach ($dbres_cmn as $tablerow) {
  $op_cmn[$tablerow->dto_id] = $tablerow->dto_nombre;
}

$com_nombre  = array(   'name' => 'com_nombre',
                        'id' => 'com_nombre',
                        'maxlength' => '50',
                        'size' => '50');

// Verifico si no se quieren editar datos. En caso de que
// se quiera editar cargo los datos en el fomrulario.
if($editar_form == 1)
{
    
    $selected_cmn = $query->dto_id;
    $com_nombre['value'] = $query->cmn_nombre;
    $com_codigo = $query->cmn_id;
}
?>

<!--comunidad panel-->
<div class="right_column">

    <!-- ADD JAVASCRIPT FOR COMUNITY -->
    <script language="javascript" src="<?php echo base_url()?>js/jcomunidad.js"></script>
    

    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>
    <?php endif ;?>
    
    <div class="sc-hdr">
        <h2 class="com-add"><?php echo $titulo_formulario; ?></h2>
        <div class="clear"></div>
    </div>
    <p class="sc-info"><?php echo $info_formulario; ?></p>
    

    <form id="form_comunity" name="form_comunity" method="post" action="<?php echo base_url().'/comunidad/guardar/'?>" class="form-item">
        <ul class="lineas">
            <li>
                <label class="cmn_nombre" for="com_nombre">*Nombre</label>
                <?php echo form_input($com_nombre); ?>
                <input type="hidden" name="com_codigo" id="com_codigo" value="<?php echo $com_codigo;?>"/>
                <div class="clear"></div>
            </li>
            <li>
                <span class="explicacion">Ingrese el nombre de la Comunidad</span>
                <div class="clear"></div>
            </li>
            <li>
                <label class="cmn_nombre" for="com_nombre">*Departamento</label>
                <?php echo form_dropdown("dto_id", $op_cmn,$selected_cmn); ?>
                <div class="clear"></div>
            </li>
            <li>
                <span class="explicacion">Seleccione el departamento de la comunidad.</span>
                <div class="clear"></div>
                <label id="documento_repetido" name="documento_repetido" class="error">Los datos de comunidad ya existen. Favor verificar.</label>
                <div class="clear"></div>
            </li>
            <hr />
            <li>
                <input class="bt-cmn-add" type="submit" value="Agregar" />
                <div class="clear"></div>
            </li>
        </ul>
    </form>


</div>
<div class="clear"></div>

<?php
/* Fin de archivo agregar.php */
/* Ubicacion: ./motor/views/comunidad/agregar.php */
?>