<?php

$miembro_nombre  = array(   'name' => 'miembro_nombre',
                        'id' => 'miembro_nombre',
                        'maxlength' => '50',
                        'size' => '50',
                        'readonly' => 'true');

$aporte_monto  = array(   'name' => 'aporte_monto',
                        'id' => 'aporte_monto',
                        'size' => '10',
                        'maxlength' => '10');
$aporte_fecha = array(   'name' => 'aporte_fecha',
                        'id' => 'aporte_fecha',
                        'size' => '10',
                        'maxlength' => '10');

$aporte_fecha_server = '';
$miembro_id = '';
$aporte_id = '';

if($editar_form == 1)
{
    $miembro_nombre['value'] = $nombre_persona;
    $aporte_monto['value'] = $query->apr_monto;
    $miembro_id = $query->mmb_id;
    $aporte_fecha_server = date("Y-m-d", strtotime($query->apr_fecha));;
    $aporte_fecha['value'] = date("m-d-Y", strtotime($query->apr_fecha));
    $aporte_id = $query->apr_id;
}
?>

<!-- se llama a la funcion de jquery ui que crea los tabs a partir de los div -->
<script type="text/javascript">
    var current_row = null;
    var current_id = null;
    var current_nombre = null;

    function llamar(codigo, nombre, otromas){
        current_id = codigo;
        current_nombre = nombre;
        //$('#nombrexx').val(nombre);
        //$('#codigoxx').val(codigo);
        //document.getElementById('nombrexx').style.background = '#333333';
        //otromas.style.background = '#333333';
        
        if (current_row != null){
            current_row.setAttribute("class", 'pr-row-miembro');
        }
        otromas.setAttribute("class", 'pr-row-miembro-marc');
        current_row = otromas;
    }
</script>

<!--comunidad panel-->
<div class="right_column">

    <!-- ADD JAVASCRIPT FOR COMUNITY -->
    <script language="javascript" src="<?php echo base_url()?>js/japorte.js"></script>

    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>
    <?php endif ;?>
    
    <div class="sc-hdr">
        <h2 class="aprt-add"><?php echo $titulo_formulario; ?></h2>
        <div class="clear"></div>
    </div>
    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <div id="prompt" title="Seleccionar Miembro">
        <form>
            <label for="text_buscar">Buscar:</label>
            <input type="text" name="text_buscar" id="text_buscar" maxlength="50"/>
            <input type="button" id="btn-search" name="btn-search" value="Buscar" />
        </form>

        <div id="tabla-valores" class="prompt-miembros"></div>
    </div>

    <form id="form_aporte" name="form_aporte" method="post" action="<?php echo base_url().'aporte/guardar/'?>" class="form-item">
        <input type="hidden" name="aporte_id" id="aporte_id" value="<?php echo $aporte_id ?>"/>
        <ul class="lineas">
            <li>
                <label class="aprt_lb" for="miembro_nombre">Nombre</label>
                <?php echo form_input($miembro_nombre); ?>
                <input type="hidden" name="miembro_id" id="miembro_id" value="<?php echo $miembro_id ?>"/>
                <input type="button" value="Seleccionar" onclick="$('#prompt').dialog('open');"/>
                <div class="clear"></div>
            </li>
            <li>
                <span class="expl-aprt">Escriba el nombre del miembro y seleccione de la lista que aparece.</span>
                <div class="clear"></div>
            </li>
            <li>
                <label class="aprt_lb" for="aporte_monto">Monto</label>
                <?php echo form_input($aporte_monto); ?>
                <div class="clear"></div>
            </li>
            <li>
                <span class="expl-aprt">Ingrese el monto del aporte en guaranies</span>
                <div class="clear"></div>
            </li>
            <li>
                <label class="aprt_lb" for="aporte_fecha">Fecha del Aporte</label>
                <?php echo form_input($aporte_fecha); ?>
                <input type="hidden" name="aporte_fecha_server" id="aporte_fecha_server" value="<?php echo $aporte_fecha_server ?>"/>
                <input type="hidden" name="com_codigo" id="com_codigo" />
                <div class="clear"></div>
            </li>
            <li>
                <span class="expl-aprt">Ingrese la fecha que corresponde al pago.</span>
                <div class="clear"></div>
            </li>
            <hr />
            <li>
                <input class="bt-apr-add" type="submit" value="Agregar" />
                <div class="clear"></div>
            </li>
        </ul>
    </form>


</div>
<div class="clear"></div>

<?php
/* Fin de archivo agregar.php */
/* Ubicacion: ./motor/views/aporte/agregar.php */
?>