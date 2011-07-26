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
            <div class="col-nombre">Fecha</div>
            <div class="col-nombre">Monto</div>
            <div class="clear"></div>
        </div>
        <ul class="list-row">
        <!-- listar aportes -->
        <?php $count = 0; $cont = 0; $subTotal = 0; $Total = 0; foreach ($query as $row): if($count % 2){ $clase = "linea1"; }else{ $clase = "linea2"; }?>
            <li class="<?php echo $clase; ?>">
				<?php 
					if ($cont == 0){
						$miembro = $row->mmb_id;
						$cont++;
					}	
				?>
			
					<?php 
						if ($miembro != $row->mmb_id){
							$cont=0;
							echo '<div class="clear" style="padding-right:195px; float:right"> <b>'.$subTotal.' Gs.</b> </div>';	
						    echo '<br>';
							echo '<br>';
							$subTotal=0;
						}
					?>
				
				
                <div class="col-nombre"><?php echo $row->nombres.' '.$row->apellidos .' - '.$row->num_doc; ?></div>
                <div class="col-nombre"><?php echo date('Y-m-d', strtotime($row->apr_fecha)); ?></div>
                <div class="col-nombre"><?php echo $row->apr_monto;?> Gs.</div>
				
				<?php $subTotal += $row->apr_monto;
				      $Total    += $row->apr_monto;
				?>
				
				<div class="clear"></div>
            </li>
		<div class="clear"></div>	
		<?php endforeach;?>
		
		<?php echo '<div class="clear" style="padding-right:200px; float:right"> <b>'.$subTotal.' Gs.</b> </div>';?>	
		 
		<div class="clear" style="padding-top:10px; padding-right:200px; float:right"><?php echo '<b> Total: '.$Total.' Gs.</b>' ;?></div>			
			
	
		
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