<!-- right column -->
<div class="right_column">

<!-- tipo de relacion -->
<div class="relacion-panel">

    <!-- JAVASCRIPT PARA RELACION -->
    <script language="javascript" src="<?php echo base_url()?>js/jrelacion.js"></script>

    <form id="form_relacion" name="form_relacion" method="post" action="<?php echo base_url()."admin/insertar_relacion/";?>">
    <fieldset id="basic" class="relacion-form">
        <legend>Agregar Tipo de Relacion</legend>

            <ul class="lineas">
                <li>
                    <label for="rlc_nombre">Nombre
                        <span class="small">Ingrese el nombre del Tipo de R.</span>
                    </label>
                <input type="text" name="rlc_nombre" id="rlc_nombre" />
                <input type="hidden" name="rlc_codigo" id="rlc_codigo" />
                <button type="submit">Guardar</button>
                <div class="clear"></div>
                </li>
            </ul>

    </fieldset>
    </form>
</div>
</div>
<div class="clear"></div>

<?php
/* Fin de archivo relacion_agregar.php */
/* Ubicacion: ./motor/views/admin/relacion_agregar.php */
?>