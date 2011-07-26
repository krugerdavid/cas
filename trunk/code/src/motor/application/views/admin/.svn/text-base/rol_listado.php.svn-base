<!-- ARCHIVOS JAVASCRIPT -->
<script language="javascript">
$(document).ready(function(){
    $("#agregar_rol").click(function () {
        window.location.replace(base_url + "admin/agregar_rol/");
    });

    $("#rol_buscar").keyup(function(e) {
        if(e.keyCode == 13) {
            if ($("#rol_buscar").val() != '')
                window.location = base_url + 'admin/buscar_rol/' + $("#rol_buscar").val();
        }
    });

});
</script>

<!-- right column -->
<div class="right_column">

<!-- ROL LISTADO -->
<div class="rol-panel">
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>

    <div class="sc-hdr">
        <h2 class="rol-lst">&Uacute;ltimos Roles</h2>
        <form class="frm-srch" id="form2" name="form_rol_buscar" method="post" action="">
            <input type="text" name="rol_buscar" id="rol_buscar" size="25" maxlength="25"  onblur="if (this.value == '') {this.value = 'Buscar...';}" onfocus="if (this.value == 'Buscar...') {this.value = '';}" value="Buscar..." />
        </form>
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
        <?php $count = 0; foreach ($query as $item): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
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
            No se tienen registros de roles con dichos parametros.
        </div>
    <?php endif; ?>
	</div>
</div>
</div>
<div class="clear"></div>

<?php
/* Fin de archivo rol_listado.php */
/* Ubicacion: ./motor/views/admin/rol_listado.php */
?>