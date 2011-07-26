<!-- right column -->
<div class="right_column">

<!-- rol -->
<div class="rol-panel">

    <!-- JAVASCRIPT PARA ROL -->
    <script language="javascript" src="<?php echo base_url()?>js/jrol.js"></script>

    <form id="form_rol" name="form_rol" method="post" action="<?php echo base_url()."admin/guardar_rol";?>">
    <fieldset id="basic" class="rol-form">
        <legend>Editar Rol</legend>

            <ul class="lineas">
                <li>
                    <label for="rol_nombre">Nombre
                        <span class="small">Ingrese el nombre del Rol</span>
                    </label>
                <input type="text" name="rol_nombre" id="rol_nombre" value="<?php echo $rol->rol_nombre;?>" />
                <input type="hidden" name="rol_codigo" id="rol_codigo" value="<?php echo $rol->rol_id;?>" />
                <button type="submit">Guardar</button>
                <div class="clear"></div>
                </li>
            </ul>

    </fieldset>


	<fieldset class="rol-list">
		<legend>Seleccione los modulos disponibles</legend>
		<!-- HEADER OF THE ROL LIST -->
		<div class="header">
			<div class="col-id">&nbsp;</div>
			<div class="col-description">Descripci&oacute;n</div>
			<div class="clear"></div>
		</div>

		<ul class="list-row">
		<?php foreach ($permisos as $row):?>
			<li>
				<div class="col-id"><input type="checkbox" name="permiso[]" value="<?=$row->permiso;?>" <?=$row->checked;?> ></div>
				<div class="col-description"><?=$row->prm_nombre;?></div>
				<div class="clear"></div>
			</li>
		<?php endforeach; ?>
		</ul>

	</fieldset>
    </form>
</div>
</div>
<div class="clear"></div>

<?php
/* Fin de archivo rol_editar.php */
/* Ubicacion: ./motor/views/admin/rol_editar.php */
?>