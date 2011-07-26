<!--auditoria panel-->
<div class="audit-panel">

    <!-- ADD JAVASCRIPT FOR COMUNITY -->
    <script language="javascript" src="<?php echo base_url()?>js/jauditoria.js"></script>

    <div class="section-header">
        <div class="module-options">
            <form id="form2" name="form_audit_buscar" method="post" action="<?php echo  base_url() ?>auditoria/buscar/">
                <input type="text" name="adt_buscar" id="adt_buscar" size="25" />
                <button type="submit" class="search">Buscar</button>
            </form>
        </div>
        <div class="clear"></div>
    </div>

</div>

<?php
/* Fin de archivo agregar.php */
/* Ubicacion: ./motor/views/auditoria/agregar.php */
?>