<!-- right column -->
<div class="right_column">

<!-- se agrega el javascript para las validaciones del formulario -->
<script language="javascript" src="<?php echo base_url()?>js/jmiembro.js"></script>

<!-- OTRO LISTADO -->
<div class="rol-panel">
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>

    <!-- El titulo de la pantalla-->
    <div class="sc-hdr">
        <h2 class="otr-lst"><?php echo $titulo_form; ?></h2>
        <div class="clear"></div>
    </div>

    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <div class="item-list">

    <?php if(!empty($query)):?>

		<!-- CABECERA DE LA LISTA -->
		<div class="header">
            <div class="col-doc-num">Nro. Documento</div>
			<div class="col-nombre">Apellido y Nombre</div>
			<div class="col-options">Opciones</div>
			<div class="clear"></div>
		</div>

        <ul class="list-row">

		<!-- Listar los otros familiares del miembro -->
		<?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
                <div class="col-doc-num"><?=$row->prs_doc_num;?></div>
				<div class="col-nombre"><?php echo $row->prs_apellidos.", ".$row->prs_nombres;?></div>
				<div class="col-hijo-options">
                <?php if (isset($otros_miembros[$row->prs_id])){?>
                    <a href="<?php echo base_url();?>miembro/editar/<?php echo $row->prs_id;?>/" class="editar-item">Editar</a>  |
                <?php }else{ ?>
                    <?php if ($this->myutils->mayor_de_edad($row->prs_fecha_nacimiento)){?>
                       <a  href="#" onclick="<?php echo 'otro_a_miembro('.$miembro_id.','.$row->prs_id.')';?>" class="hijo-a-mmb-item">A Miembro</a>  |
                    <?php } ?>
                    <a href="<?php echo base_url();?>miembro/otro_editar/<?php echo $miembro_id.'/'.$row->prs_id;?>/" class="editar-item">Editar</a>  |
                <?php } ?>
                    <a href="<?php echo base_url();?>miembro/otro_eliminar/<?php echo $miembro_id.'/'.$row->prs_id;?>/" class="eliminar-item">Eliminar</a>
				</div>
				<div class="clear"></div>
			</li>
		<?php $count++; endforeach; ?>
		</ul>

	<?php else: ?>
        <div class="empty-database">
            El miembro no cuenta con registros de otros integrantes de su familia.
        </div>
    <?php endif; ?>
	</div>
</div>
</div>
<div class="clear"></div>

<?php
/* Fin de archivo hijo_listado.php */
/* Ubicacion: ./motor/views/admin/hijo_listado.php */
?>