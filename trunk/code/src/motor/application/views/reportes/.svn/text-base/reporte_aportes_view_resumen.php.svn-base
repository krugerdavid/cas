<!-- right column -->
<div class="right_column">

    <!-- MESSAGE BOX PARA AVISOS -->
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>
    <?php endif ;?>
	
	 <br>
	
	 <div id="lista-comunidades"  class="item-list">

	<?php if(!empty($query)):?>
        <!-- HEADER OF THE APORTES LIST -->
        <div class="header">
            <div class="col-nombre">Nombre</div>
            <div class="col-nombre">Monto</div>
            <div class="clear"></div>
        </div>
        <ul class="list-row">
        <!-- listar aportes -->
        <?php $count = 0; $cont = 0; $Total = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
				
				<div class="col-nombre"><?php echo $row->nombres.' '.$row->apellidos .' - '.$row->num_doc; ?></div>
                <div class="col-nombre"><?php echo $row->monto;?> Gs.</div>
				
				<?php 
					$Total  += $row->monto;
				?>
				
				<div class="clear"></div>
            </li>
		<div class="clear"></div>	
		<?php endforeach;?>
		
				 
		<div class="clear" style="padding-top:10px; padding-right:395px; float:right"><?php echo '<b> Total: '.$Total.' Gs.</b>' ;?></div>			
			
	
		
        </ul>
        <? if(!empty($paginacion)){ ?><ul id="pagination"><?=$paginacion;?></ul><? } ?>
        <?php else: ?>

        <div class="empty-database">
            <p>No hay datos que mostrar.</p>
        </div>
        <?php endif; ?>
    </div>



</div>
<div class="clear"></div>

<?php
/* Fin de archivo panel.php */
/* Ubicacion: ./motor/views/comunidad/panel.php */
?>