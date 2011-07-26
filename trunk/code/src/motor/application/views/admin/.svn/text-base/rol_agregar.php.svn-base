<!-- right column -->
<div class="right_column">

<!-- rol -->
<div class="rol-panel">

    <!-- JAVASCRIPT PARA ROL -->
    <script language="javascript" src="<?php echo base_url()?>js/jrol.js"></script>
    
    <form id="form_rol" name="form_rol" method="post" action="<?php echo base_url()."admin/insertar_rol/";?>">
    <fieldset id="basic" class="rol-form">
        <legend>Agregar Rol</legend>
        
            <ul class="lineas">
                <li>
                    <label for="rol_nombre">Nombre
                        <span class="small">Ingrese el nombre del Rol</span>
                    </label>
                <input type="text" name="rol_nombre" id="rol_nombre" />
                <input type="hidden" name="rol_codigo" id="rol_codigo" />
                <button type="submit">Guardar</button>
                <div class="clear"></div>
                </li>
            </ul>
    
    </fieldset>

	<fieldset class="rol-option">
		<legend>Seleccione los modulos disponibles</legend>

<?php
$count = 0;
$modulos = $this->rol_modelo->obtener_modulos();
    foreach($modulos as $modulo){
    ?>
    <div class="modulos-list">
    <ul>
        <li><input type="checkbox" id="check_<?php echo ucfirst($modulo->prm_controller) ?>" onclick="jqCheckAll(this.id, 'check_<?php echo $modulo->prm_controller ?>');"><span><?php echo $modulo->prm_modulo?></span>
        <?php
        $permisos = $this->rol_modelo->obtener_permisos_modulo($modulo->prm_controller);
        if(!empty($permisos)){
            echo '<ul id=check_'.$modulo->prm_controller.'>';
            foreach($permisos as $permiso){
        ?>
            <li><input type="checkbox" name="permiso[]" onclick="jqCheckParent(this.id,'check_<?php echo ucfirst($modulo->prm_controller) ?>');" value="<?php echo $permiso->prm_id ?>"><span><?php echo $permiso->prm_nombre ?></span></li>
        <?php
        }
        echo '</ul>';
        }
        ?>
        </li>
    </ul>
    </div>
<?php
    $count++;
    if($count == 3){ echo '<div class=clear></div>'; }
}
?>

        

<div class="clear"></div>
    </fieldset>
    </form>
</div>
</div>
<div class="clear"></div>

<?php
/* Fin de archivo rol_agregar.php */
/* Ubicacion: ./motor/views/admin/rol_agregar.php */
?>