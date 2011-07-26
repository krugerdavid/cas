<!--confesion panel-->
<div class="right_column">

    <!-- ADD JAVASCRIPT FOR CONFETION -->
    <script language="javascript" src="<?php echo base_url()?>js/jconfesion.js"></script>

    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>
    <?php endif ;?>

    <fieldset id="basic" class="comunity-edit">
        <legend>Editar Confesion</legend>
        <form id="form_confetion" name="form_confetion" method="post" action="" class="form-item">
            <ul class="lineas">
                <li>
                    <label class="cmn_nombre" for="con_nombre">Nombre</label>
                    <input type="text" name="con_nombre" id="con_nombre" size="50" maxlength="50" />
                    <input type="hidden" name="con_codigo" id="con_codigo" />
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

    <div class="sc-hdr">
        <h2 class="cnf-lst"><?php echo $titulo_formulario; ?></h2>
        <form class="frm-srch" id="form2" name="form_confetion_buscar" method="post" action="<?php echo  base_url() ?>confesion/buscar/">
            <input type="text" name="con_buscar" id="con_buscar" size="50" maxlength="50" onblur="if (this.value == '') {this.value = 'Buscar...';}" onfocus="if (this.value == 'Buscar...') {this.value = '';}" value="Buscar..." />
        </form>
        <div class="clear"></div>
    </div>
    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <div id="lista-confesiones" class="item-list">


        <?php if(!empty($query)):?>
        <!-- HEADER OF THE CONFETION LIST -->
        <div class="header">
            <div class="col-cmn-nmbr">Nombre</div>
            <div class="col-opt-min">&nbsp;</div>
            <div class="clear"></div>
        </div>
        <ul class="list-row">
        <!-- LIST ALL THE CONFETIONS -->
        <?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
            <div class="col-cmn-nmbr"><?=$row->cnf_nombre;?></div>
                <div class="col-opt-min">
                <?php  $cnf_nombre = "'{$row->cnf_nombre}'"; ?>
                    <a href="#" onclick="editar_confesion(<?php echo $row->cnf_id;?>,<?php echo $cnf_nombre;?>)" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>
                    <a href="javascript:cnf_do_delete(<?php echo $row->cnf_id;?>)" class="eliminar-min"><img src="<?php echo base_url();?>/images/admin/item-delete-min.png" width="16" height="16" alt="Eliminar Item" /></a>

                </div>
                <div class="clear"></div>
            </li>
        <?php endforeach; ?>
        </ul>
        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>
        <?php else: ?>

        <div class="empty-database">
            <p>No hay confesiones almacenadas en la base de datos.</p>
        </div>
        <?php endif; ?>
    </div>

    <script type="text/javascript">
        $('#con_buscar').alphanumeric({ichars:' '});
    </script>


</div>
<div class="clear"></div>

<?php
/* Fin de archivo panel.php */
/* Ubicacion: ./motor/views/comunidad/panel.php */
?>
