<!-- left column -->
<div class="left_column">
<div class="menu-panel">
    <ul>
    <!-- USUARIOS -->
    <?php

    $modulo = $this->uri->segment(1);
    $modulos = $this->usuario_modelo->obtener_permisos_usuario($this->datos_usuario->rol_id, $modulo);

    foreach($modulos as $item){
        if($item->prm_nombre == 'Agregar Confesion')
        {
            ?>
            <li>
                <a href="<?php echo base_url() ?>confesion/agregar" class="cnf-add">
                <strong>Agregar Confesion</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>
            <?
        }

        if($item->prm_nombre == 'Listar Confesiones')
        {
            ?>
            <li>
                <a href="<?php echo base_url() ?>confesion/" class="cnf-lst">
                <strong>Listar Confesiones</strong></a>
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
<form method="post" action="<?php echo  base_url() ?>confesion/listar_confesiones/" class="form-item">
<ul class="lineas">
    <li>
        <select name="cnf_sort">
            <option value="cnf_nombre">Confesion</option>
        </select>
    </li>
    <li>
        <select name="cnf_sort_dir">
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