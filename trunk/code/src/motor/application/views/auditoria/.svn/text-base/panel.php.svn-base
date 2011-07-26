<!--auditoria panel-->
<div class="audit-panel">

    <!-- ADD JAVASCRIPT FOR CONFETION -->
    <script language="javascript" src="<?php echo base_url()?>js/jauditoria.js"></script>

    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>

    <div class="sc-hdr">
        <h2 class="audt-lst">Listado de auditoria</h2>


        <form method="post" action="<?php echo  base_url() ?>auditoria/listar_logs/"  class="frm-srch" >


        <select name="aud_sort">
            <option value="usr_nombre">Usuario</option>
            <option value="adt_hora_trans">Fecha</option>
            <option value="adt_nombre_tabla">Tabla</option>
            <option value="adt_nombre_col">Columna</option>
            <option value="adt_evento">Evento</option>
        </select>


        <select name="aud_sort_dir">
            <option value="asc">Ascendente</option>
            <option value="desc">Descendente</option>
        </select>

        <input type="submit" value="Ordenar" />

        </form>

        <div class="clear"></div>
    </div>

    <div class="audit-list">

    <?php if(!empty($query)):?>

        <!-- HEADER OF THE audit LIST -->
        <div class="header">
            <div class="col-user">Usuario</div>
            <div class="col-tabla">Tabla->Columna</div>
            <div class="col-ant">Valor Anterior</div>
            <div class="col-nuevo">Valor Nuevo</div>
            <div class="clear"></div>
        </div>
        <ul class="list-row">
        <!-- LIST ALL THE AUDIT -->
        <?php $count = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
                <div class="col-user">
                    <span class="audt-usr"><?php echo $row->usr_nombre; ?></span><br />
                    <span class="audt-hour"><?php echo $row->adt_hora_trans?></span>
                </div>
                <div class="col-tabla">
                    <span class="audt-elemento"><?php echo $row->adt_nombre_tabla.'->'.$row->adt_nombre_col; ?></span><br />
                    <span class="audt-accion"><?php echo $row->adt_evento?></span>
                </div>
                <div class="col-ant">
                    <span class="audt-ant"><?php echo $row->adt_valor_ant; ?></span>
                </div>
                <div class="col-nuevo">
                    <span class="audt-nuev"><?php echo $row->adt_valor_nuevo; ?></span>
                </div>
  
                <div class="clear"></div>
            </li>
        <?php $count++; endforeach; ?>
        </ul>
        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>
    <?php else: ?>
        <div class="empty-database">
           <p>No existen registros de auditoria en el sistema</p>
        </div>
    <?php endif; ?>
    </div>
</div>
<?php
/* Fin de archivo panel.php */
/* Ubicacion: ./motor/views/auditoria/panel.php */
?>