<!-- right column -->
<div class="right_column">

    <!-- ADD JAVASCRIPT FOR COMUNITY -->
    <script language="javascript" src="<?php echo base_url()?>js/jcomunidad.js"></script>

    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>
    <?php endif ;?>

    <fieldset id="basic" class="comunity-edit">
        <legend>Editar Comunidad</legend>
        <form id="form_comunity" name="form_comunity" method="post" action="" class="form-item">
            <ul class="lineas">
                <li>
                    <label class="cmn_nombre" for="com_nombre">Nombre</label>
                    <input type="text" name="com_nombre" id="com_nombre" size="50" maxlength="50" />
                    <input type="hidden" name="com_codigo" id="com_codigo" />
                    <div class="clear"></div>
                </li>
                <li>
                    <span class="explicacion">Ingrese el nombre de la Comunidad</span>
                    <div class="clear"></div>
                </li>
                <li>
                    <input class="bt-cmn-add" type="submit" value="Guardar" />
                    <input type="reset" class="button" id="cancelar" value="Cancelar" />
                    <div class="clear"></div>
                </li>

            </ul>
        </form>
    </fieldset>

    <div id="lista-comunidades" class="item-list">
        <div class="sc-hdr">
            <h2 class="com-lst"><?php echo $titulo_formulario; ?></h2>
            
            <form class="frm-srch" id="form2" name="form_comunity_buscar" method="post" action="<?php echo  base_url() ?>comunidad/buscar/">
                <input type="text" name="com_buscar" id="com_buscar" size="25" onblur="if (this.value == '') {this.value = 'Buscar...';}" onfocus="if (this.value == 'Buscar...') {this.value = '';}" value="Buscar..." />
            </form>
            
            <div class="clear"></div>
        </div>

        <p class="sc-info"><?php echo $info_formulario; ?></p>

        <?php if(!empty($query)):?>
        <!-- HEADER OF THE COMUNITY LIST -->
        <div class="header">

            <div class="col-description">Nombre</div>
            <div class="col-doc-num">Departamento</div>
            <div class="col-opt-min">&nbsp;</div>
            <div class="clear"></div>

        </div>
        <ul class="list-row">
        <!-- LIST ALL THE COMUNITIES -->
        <?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
                <div class="col-description"><?php echo $row->cmn_nombre;?></div>
                <div class="col-doc-num"><?php echo $this->Comunidad_model->obtener_departamento($row->dto_id);?></div>
                <div class="col-opt-min">
                <?php  $com_nombre = "'{$row->cmn_nombre}'"; ?>
                    <a href="<?php echo base_url();?>comunidad/modificar/<?php echo $row->cmn_id;?>/" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>
                    <a href="javascript:cmn_do_delete(<?php echo $row->cmn_id;?>)" class="eliminar-min"><img src="<?php echo base_url();?>/images/admin/item-delete-min.png" width="16" height="16" alt="Eliminar Item" /></a>

                </div>
                <div class="clear"></div>
            </li>
        <?php endforeach; ?>
        </ul>
        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>
        <?php else: ?>

        <div class="empty-database">
            <p>No hay comunidades almacenadas en la base de datos.</p>
        </div>
        <?php endif; ?>
    </div>

    <script type="text/javascript">
        $('#com_buscar').alphanumeric({ichars:' '});
    </script>


</div>
<div class="clear"></div>

<?php
/* Fin de archivo panel.php */
/* Ubicacion: ./motor/views/comunidad/panel.php */
?>