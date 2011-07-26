<!-- ARCHIVOS JAVASCRIPT -->
<script language="javascript">
$(document).ready(function(){

    $("#rlc_buscar").keyup(function(e) {
        if(e.keyCode == 13) {
            if ($("#rlc_buscar").val() != '')
                window.location = base_url + 'admin/buscar_relacion/';
        }
    });

});
</script>

<!-- right column -->
<div class="right_column">

<!-- ROL LISTADO -->
<div class="rol-panel">

    <!-- AGREGAR JAVASCRIPT PARA TIPO DE RELACIONES -->
    <script language="javascript" src="<?php echo base_url()?>js/jrelacion.js"></script>

    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
    <?php endif ;?>

    <fieldset id="basic" class="comunity-edit">
        <legend>Editar Tipo de Relacion</legend>
        <form id="form_relacion" name="form_relacion" method="post" action="">
            <ul class="lineas">
                <li>
                    <label for="rlc_nombre">Nombre</label>
                    <input type="text" name="rlc_nombre" id="rlc_nombre" />
                    <input type="hidden" name="rlc_codigo" id="rlc_codigo" />
                    <button type="submit">Guardar</button>
                    <input type="reset" class="button" id="cancelar" value="Cancelar" />
                    <div class="clear"></div>
                </li>
            </ul>
        </form>
    </fieldset>

    <div class="sc-hdr">
        <h2 class="relc-lst">Listado de Tipo de Relaciones</h2>
            <form class="frm-srch" id="form2" name="form_relacion_buscar" method="post" action="">
                <input type="text" name="rlc_buscar" id="rlc_buscar" size="25" maxlength="25" />
            </form>
        </div>
        <div class="clear"></div>
    </div>   

    <div class="item-list">

        <?php if(!empty($query)):?>
        <!-- HEADER OF THE COMUNITY LIST -->
            <div class="header">
                <div class="col-rol">Nombre</div>
                <div class="col-opt-min">&nbsp;</div>
                <div class="clear"></div>
            </div>
            <ul class="list-row">
            <!-- LIST ALL THE COMUNITIES -->
            <?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
                <li class="<?php echo $clase; ?>">
                    <div class="col-rol"><?=$row->rlc_tipo;?></div>
                    <div class="col-opt-min">
                    <?php  $rlc_nombre = "'{$row->rlc_tipo}'"; ?>
                        <a href="#" onclick="editar_comunidad(<?php echo $row->rlc_id;?>,<?php echo $rlc_nombre;?>)" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>

                    </div>
                    <div class="clear"></div>
                </li>
            <?php $count++; endforeach; ?>
            </ul>
        <?php else: ?>
        <div class="empty-database">
            No se tienen registros de tipos de relaciones con dichos parametros.
        </div>
    <?php endif; ?>
    </div>
</div>
<div class="clear"></div>

<?php
/* Fin de archivo relacion_listado.php */
/* Ubicacion: ./motor/views/admin/relacion_listado.php */
?>