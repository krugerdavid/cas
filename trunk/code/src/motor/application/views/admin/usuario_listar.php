<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<!-- right column -->
<div class="right_column">

<!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
    <?php endif ;?>

    <div id="ultimos-usuarios" class="item-list">
        <div class="sc-hdr">
            <h2 class="usr-lst">Listado de Usuarios</h2>
            <div class="clear"></div>
        </div>
        <?php if(!empty($lista_usuarios)):?>
            <!-- HEADER OF THE COMUNITY LIST -->
            <div class="header">
                <div class="col-usuario">Usuario </div>
                <div class="col-ult-login">Ultimo Login</div>
                <div class="col-opt">&nbsp;</div>
                <div class="clear"></div>
            </div>
            <ul class="list-row">
            <!-- LIST ALL THE COMUNITIES -->
            <?php $count = 0; foreach ($lista_usuarios as $item): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
                <li class="<?php echo $clase; ?>">
                    <div class="col-usuario">
                        <strong><?php echo $item->prs_nombres." ".$item->prs_apellidos.'</strong> <span class=usrnm>'.$item->usr_nombre.'</span>';?><br />
                        <span class="mail"><?php echo $item->prs_email?></span>
                    </div>
                    <div class="col-ult-login">
                        <?php echo $item->usr_ultimo_login ?>
                    </div>
                    <div class="col-opt">
                        <a href="<?php echo base_url();?>admin/editar_usuario/<?php echo $item->usr_id;?>/" class="editar"><img src="<?php echo base_url();?>/images/admin/item-edit.png" width="24" height="24"  alt="Editar Item" /></a>
                        <a href="javascript:usuario_do_delete(<?=$item->usr_id;?>)" class="eliminar"><img src="<?php echo base_url();?>/images/admin/item-delete.png" width="24" height="24" alt="Eliminar Item" /></a>
                    </div>
                    <div class="clear"></div>
                </li>
            <?php $count++; endforeach; ?>
            </ul>


        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>

    <?php else: ?>
        <div class="empty-database">
           <p>No existen usuarios en el sistema</p>
        </div>
    <?php endif; ?>
</div>

</div>
<div class="clear"></div>

