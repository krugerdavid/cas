<!-- columna derecha de la pantalla 
<div class="right_column">
-->
<!-- se agrega el javascripta para las validaciones del formulario -->
<script language="javascript" src="<?php echo base_url()?>js/jmiembro.js"></script>

<!-- MIEMBRO LISTADO -->
<div class="right_column">

    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>

    <div class="sc-hdr">
        <h2 class="mmb-lst"><?php echo $titulo_list; ?></h2>
        <form class="frm-srch" id="form2" name="form_confetion_buscar" method="post" action="">
            <input type="text" name="miembro_buscar" id="miembro_buscar" size="40" maxlength="40" onblur="if (this.value == '') {this.value = 'Buscar...';}" onfocus="if (this.value == 'Buscar...') {this.value = '';}" value="Buscar..." />
        </form>
        <div class="clear"></div>
    </div>
    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <div class="item-list">
    

    <?php if(!empty($query)):?>

		<!-- CABECERA DEL LISTADO DE MIEMBROS -->
		<div class="header">
            <div class="col-doc-num">Nro. Documento</div>
			<div class="col-description">Apellido y Nombre</div>
			<div class="col-options">Opciones</div>
			<div class="clear"></div>
		</div>

        <ul class="list-row">

		<!-- LISTADO DE LAS COMUNIDADES -->
		<?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
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

        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>

	<?php else: ?>
        <div class="empty-database">
            No se tienen registros de miembros con dichos parametros.
        </div>
    <?php endif; ?>
	</div>
</div>
<!--</div>-->
<div class="clear"></div>

<?php
/* Fin de archivo miembro_listado.php */
/* Ubicacion: ./motor/views/admin/miembro_listado.php */
?>