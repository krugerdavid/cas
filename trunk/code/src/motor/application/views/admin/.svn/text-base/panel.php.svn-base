<!-- right column -->
<div class="right_column">

<!--comunidad panel-->
<div class="admin-panel">

    <div id="ultimos-usuarios" class="item-list">
        <div class="sc-hdr">
            <h2 class="usr-lst">&Uacute;ltimos Usuarios </h2>
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

            
        <?php else: ?>
            <div class="empty-database">
               <p>No existen usuarios en el sistema</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="clear"></div>



    <!-- ULTIMOS ROLES ASIGNADOS -->
    <div id="ultimos-roles" class="item-list left-col">
        <div class="sc-hdr">
            <h2 class="rol-lst">&Uacute;ltimos Roles</h2>
            <div class="clear"></div>
        </div>
        <?php if(!empty($lista_roles)):?>
            <!-- HEADER OF THE COMUNITY LIST -->
            <div class="header">
                <div class="col-rol">Nombre</div>
                <div class="col-opt-min">&nbsp;</div>
                <div class="clear"></div>
            </div>
            <ul class="list-row">
            <!-- LIST ALL THE COMUNITIES -->
            <?php $count = 0; foreach ($lista_roles as $item): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
                <li class="<?php echo $clase; ?>">
                    <div class="col-rol"><?php echo $item->rol_nombre;?></div>
                    <div class="col-opt-min">
                        <a href="<?php echo base_url();?>admin/editar_rol/<?php echo $item->rol_id;?>/" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>
                    </div>
                    <div class="clear"></div>
                </li>
            <?php $count++; endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-database">
                <p>No existen Roles en el sistema</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- ULTIMOS ROLES ASIGNADOS -->
    <div id="ultimos-tipos-relaciones" class="item-list right-col">
        <div class="sc-hdr">
            <h2 class="relc-lst">&Uacute;ltimas Relaciones</h2>
            <div class="clear"></div>
        </div>
        <?php if(!empty($lista_relaciones)):?>
            <!-- HEADER OF THE COMUNITY LIST -->
            <div class="header">
                <div class="col-rol">Nombre</div>
                <div class="col-opt-min">&nbsp;</div>
                <div class="clear"></div>
            </div>
            <ul class="list-row">
            <!-- LIST ALL THE COMUNITIES -->
            <?php $count = 0; foreach ($lista_relaciones as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
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
               <p>No existen Tipos de Relacionamiento en el sistema</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="clear"></div>

</div><!-- end of admin panel -->

</div>
<div class="clear"></div>




