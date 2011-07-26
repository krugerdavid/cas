<!-- left column -->
<div class="left_column">

    <!-- ULTIMOS MIEMBROS -->
    <div class="item-list">
        <div class="sc-hdr">
            <h2 class="mmb-lst">&Uacute;ltimos Miembros Agregados</h2>
             <div class="clear"></div>
        </div>
        <?php if(!empty($lista_miembros)):?>
		<!-- CABECERA DEL LISTADO DE MIEMBROS -->
		<div class="header">
            <div class="col-doc-num">Nro. Documento</div>
			<div class="col-description">Apellido y Nombre</div>
			<div class="col-options">Opciones</div>
			<div class="clear"></div>
		</div>

        <ul class="list-row">

		<!-- LISTADO DE LAS COMUNIDADES -->
		<?php $count = 0; foreach ($lista_miembros as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
                <div class="col-doc-num"><?=$row->prs_doc_num;?></div>
				<div class="col-description"><?php echo $row->prs_apellidos.", ".$row->prs_nombres;?></div>
				<div class="col-options">
                    <a href="<?php echo base_url();?>miembro/editar/<?php echo $row->prs_id;?>/" class="editar-item">Editar</a>  |
                    <?php if ($row->prs_estado == 'A'){?>
                        <a href="<?php echo base_url().'miembro/cambiar_estado_miembro/'.$row->prs_id;?>" class="deshabilitar-item">Deshabilitar</a>
                    <?php }else{?>
                        <a href="<?php echo base_url().'miembro/cambiar_estado_miembro/'.$row->prs_id;?>" class="habilitar-item">Habilitar</a>
                    <?php }?>
				</div>
				<div class="clear"></div>
			</li>
		<?php $count++; endforeach; ?>
		</ul>
        <?php else: ?>
        <div class="empty-database">
            No se tienen registros de miembros con dichos parametros.
        </div>
        <?php endif; ?>
    </div>
    
    <!-- ULTIMAS COMUNIDADES -->
    <div class="item-list left-col">
        <div class="sc-hdr">
            <h2 class="com-lst">&Uacute;ltimas Comunidades Agregadas</h2>
            <div class="clear"></div>
        </div>
        <?php if(!empty($lista_comunidades)):?>
            <!-- HEADER OF THE COMUNITY LIST -->
            <div class="header">
                <div class="col-rol">Nombre</div>
                <div class="col-opt-min">&nbsp;</div>
                <div class="clear"></div>
            </div>
            <ul class="list-row">
            <!-- LIST ALL THE COMUNITIES -->
            <?php $count = 0; foreach ($lista_comunidades as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
                <li class="<?php echo $clase; ?>">
                    <div class="col-rol"><?=$row->cmn_nombre;?></div>
                    <div class="col-opt-min">
                    <?php  $com_nombre = "'{$row->cmn_nombre}'"; ?>
                        <a href="#" onclick="editar_comunidad(<?php echo $row->cmn_id;?>,<?php echo $com_nombre;?>)" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>
                        <a href="javascript:cmn_do_delete(<?php echo $row->cmn_id;?>)" class="eliminar-min"><img src="<?php echo base_url();?>/images/admin/item-delete-min.png" width="16" height="16" alt="Eliminar Item" /></a>

                    </div>
                    <div class="clear"></div>
                </li>
            <?php $count++; endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-database">
            <p>No hay comunidades almacenadas en la base de datos.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- ULTIMOS ROLES ASIGNADOS -->
    <div class="item-list right-col">
        <div class="sc-hdr">
            <h2 class="cnf-lst">&Uacute;ltimas Confesiones agregadas</h2>
            <div class="clear"></div>
        </div>
        <?php if(!empty($lista_confesiones)):?>
            <!-- HEADER OF THE COMUNITY LIST -->
            <div class="header">
                <div class="col-rol">Nombre</div>
                <div class="col-opt-min">&nbsp;</div>
                <div class="clear"></div>
            </div>
            <ul class="list-row">
            <!-- LIST ALL THE COMUNITIES -->
            <?php $count = 0; foreach ($lista_confesiones as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
                <li class="<?php echo $clase; ?>">
                    <div class="col-rol"><?=$row->cnf_nombre;?></div>
                    <div class="col-opt-min">
                    <?php  $cnf_nombre = "'{$row->cnf_nombre}'"; ?>
                        <a href="#" onclick="editar_confesion(<?php echo $row->cnf_id;?>,<?php echo $cnf_nombre;?>)" class="editar-min"><img src="<?php echo base_url();?>/images/admin/item-edit-min.png" width="16" height="16"  alt="Editar Item" /></a>
                        <a href="javascript:cnf_do_delete(<?php echo $row->cnf_id;?>)" class="eliminar-min"><img src="<?php echo base_url();?>/images/admin/item-delete-min.png" width="16" height="16" alt="Eliminar Item" /></a>

                    </div>
                    <div class="clear"></div>
                </li>
            <?php $count++; endforeach; ?>
            </ul>
        <?php else: ?>
            <div class="empty-database">
               <p>No existen Confesiones almacenadas en la base de datos</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="clear"></div>

</div> 