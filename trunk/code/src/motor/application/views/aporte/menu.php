<!-- left column -->
<div class="left_column">
<div class="menu-panel">
<ul>
<!-- USUARIOS -->
<?php

$modulo = $this->uri->segment(1);
$modulos = $this->usuario_modelo->obtener_permisos_usuario($this->datos_usuario->rol_id, $modulo);

foreach($modulos as $item){
    if($item->prm_nombre == 'Agregar Aporte')
    {
        ?>
        <li>
            <a href="<?php echo base_url() ?>aporte/agregar" class="aprt-add">
            <strong>Agregar Aporte</strong></a>
            <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
            <div class="clear"></div>
        </li>
        <?
    }

    if($item->prm_nombre == 'Listar Aportes')
    {
        ?>
        <li>
            <a href="<?php echo base_url() ?>aporte/listar_aporte/" class="aprt-lst">
            <strong>Listar Aportes</strong></a>
            <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
            <div class="clear"></div>
        </li>
        <?
    }

}

?>

</ul>
</div>
<fieldset class="order-list">
<legend>Ordenar Lista</legend>
<form method="post" action="<?php echo  base_url() ?>aporte/listar_aporte/" class="form-item">
<ul class="lineas">
    <li>
        <select name="apr_sort">
            <option value="mmb_id">Miembro</option>
            <option value="apr_fecha">Fecha</option>
        </select>
    </li>
    <li>
        <select name="apr_sort_dir">
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </select>
    </li>
    <li>
        <input type="submit" value="Ordenar" />
    </li>
</ul>
</form>
</fieldset>
</div>