<!--confesion panel-->
<div class="right_column">

    <!-- ADD JAVASCRIPT FOR CONFETION -->
    <script language="javascript" src="<?php echo base_url()?>js/jconfesion.js"></script>

    <div class="sc-hdr">
        <h2 class="cnf-add"><?php echo $titulo_formulario; ?></h2>
        <div class="clear"></div>
    </div>
    <p class="sc-info"><?php echo $info_formulario; ?></p>

    <form id="form_confetion" name="form_confetion" method="post" action=""  class="form-item">
        <ul class="lineas">

            <li>
                <label class="cmn_nombre" for="con_nombre">*Nombre</label>
                <input type="text" name="con_nombre" id="con_nombre" size="50" maxlength="50" />
                <input type="hidden" name="con_codigo" id="con_codigo" />
                <div class="clear"></div>
            </li>
            <li>
                <span class="explicacion">Ingrese el nombre de la Confesion</span>
                <div class="clear"></div>
                <label id="documento_repetido" name="documento_repetido" class="error">La confesion con ese nombre ya existe. Favor verificar.</label>
                <div class="clear"></div>
            </li>
            <hr />
            <li>
                <input class="bt-cmn-add" type="submit" value="Agregar" />
                <div class="clear"></div>
            </li>
        </ul>
    </form>

</div>
<div class="clear"></div>

<?php
/* Fin de archivo agregar.php */
/* Ubicacion: ./motor/views/confesion/agregar.php */
?>