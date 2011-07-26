
<!-- left column -->
<div class="left_column">
    <div class="menu-panel">

        <!-- MIEMBROS -->
        <ul>
            <li>
                <a href="<?php echo base_url() ?>miembro/agregar" class="memb-add">
                <strong>Agregar Miembro</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>
            <li>
                <a href="<?php echo base_url() ?>miembro/" class="memb-lst">
                <strong>Listar Miembros</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>
    
            <?php if ($mostrar_integrantes == 'TRUE') {?>

            <!-- CONYUGUE -->
            <li><a href="<?php echo base_url() ?>miembro/conyugue_agregar/<?php echo $miembro_id ?>" class="memb-cny">
                <strong>Datos del Conyugue</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>

            <!-- HIJOS -->
            <li>
                <a href="<?php echo base_url() ?>miembro/hijo_agregar/<?php echo $miembro_id ?>" class="hijo-add">
                <strong>Agregar Hijo</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>
            <li>
                <a href="<?php echo base_url() ?>miembro/hijo_listar/<?php echo $miembro_id ?>" class="hijo-lst">
                <strong>Listar Hijos</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>

             <!-- OTROS --> 
            <li>
                <a href="<?php echo base_url() ?>miembro/otro_agregar/<?php echo $miembro_id ?>" class="otro-add">
                <strong>Agregar Otro Integrante</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>
            <li>
                <a href="<?php echo base_url() ?>miembro/otro_listar/<?php echo $miembro_id ?>" class="otro-lst">
                <strong>Listar otros Integrantes</strong></a>
                <img class="arrow" height="11" width="8" alt="Arrow" src="<?php echo base_url() ?>/images/arrow-menu.png"/>
                <div class="clear"></div>
            </li>

        <?php }?>
        </ul>

        <!-- JERARsQUIA USUARIOS
        <h2>Jerarqu&iacute;as de Personas</h2>
        <ul>
            <li><a href="<?php echo base_url() ?>admin/agregar_jerarquia_persona">Agregar</a></li>
            <li><a href="<?php echo base_url() ?>admin/listar_jerarquia_persona">Listar</a></li>
        </ul>
        -->
    </div>
    
    <?php if ($mostrar_integrantes != 'TRUE'): ?>
    <fieldset class="order-list">
    <legend>Ordenar Lista</legend>
    <form method="post" action="<?php echo  base_url() ?>miembro/listar_miembro/" class="form-item">
    <ul class="lineas">
        <li>
            <select name="mmb_sort">
                <option value="prs_doc_num">N. de Documento</option>
                <option value="prs_apellidos">Apellidos</option>
                <option value="prs_nombres">Nombres</option>
            </select>
        </li>
        <li>
            <select name="mmb_sort_dir">
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
    <?php endif; ?>
</div>
