<!-- right column -->
<div class="right_column">

    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>
    <?php endif ;?>

    <div id="lista-comunidades" class="item-list">
        <div class="sc-hdr">
            <h2 class="aprt-lst"><?php echo $titulo_formulario; ?></h2>
            <div class="clear"></div>
        </div>

        <p class="sc-info"><?php echo $info_formulario; ?></p>

        <?php if(!empty($query)):?>
        <!-- HEADER OF THE COMUNITY LIST -->
        <div class="header">
            <div class="col-nombre">Nombre</div>
            <div class="col-nombre">Fecha</div>
            <div class="col-rol">Monto</div>
            <div class="col-opt-min">&nbsp;</div>
            <div class="clear"></div>
        </div>
        <ul class="list-row">
        <!-- LIST ALL THE COMUNITIES -->
        <?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
                <div class="col-nombre"><?php $persona = $this->miembro_modelo->obt_persona_x_id($row->mmb_id); echo $persona->prs_apellidos.' '.$persona->prs_nombres; ?></div>
                <div class="col-nombre"><?php echo date('Y-m-d', strtotime($row->apr_fecha)); ?></div>
                <div class="col-rol"><? echo $row->apr_monto;?> Gs.</div>
                <div class="col-opt-min">
                    <a href="<?php echo base_url();?>aporte/editar/<?php echo $row->apr_id;?>/" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>
                </div>
                <div class="clear"></div>
            </li>
        <?php endforeach; ?>
        </ul>
        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>
        <?php else: ?>

        <div class="empty-database">
            <p>No hay Aportes almacenados en la base de datos.</p>
        </div>
        <?php endif; ?>
    </div>



</div>
<div class="clear"></div>

<?php
/* Fin de archivo panel.php */
/* Ubicacion: ./motor/views/comunidad/panel.php */
?>