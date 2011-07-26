

	<?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>
	
	<br>
	
	 <!-- listar miembros-->
    <div class="comunity-list">

    <?php if(!empty($query)):?>

        <!-- HEADER OF THE COMUNITY LIST -->
        <div class="header">
			<div class="col-id">Num. Doc.</div>
			<div class="col-short-desrip">Nombres</div>
			<div class="col-short-desrip">Apellidos</div>
			<div class="col-id">Telefono</div>
			<div class="col-id">Fecha Nac.</div>			
			<div class="col-id">Comunidad</div>
			<div class="col-id">Confesion</div>
			<div class="col-id">Opcion</div>
            <div class="clear"></div>
        </div>

        <ul class="list-row">
        <!-- LIST ALL THE COMUNITIES -->
        <?php $cantidad=0; foreach ($query as $row):?>
								
            <li>
				<div class="col-id"><?=$row->num_doc;?>&nbsp;</div>
				<div class="col-short-desrip"><?=$row->nombres;?></div>					
				<div class="col-short-desrip"><?=$row->apellidos;?></div>					
				<div class="col-id"><?=$row->telefono;?>&nbsp;</div>
				<div class="col-id"><?=date("Y-m-d", strtotime($row->fecha_nac));?>&nbsp;</div>
				<div class="col-id"><?=$row->comunidad;?></div>					
				<div class="col-id"><?=$row->confesion;?></div>		
				
				<div class="col-id">
                     <a href="<?php echo base_url();?>reportes/reporte_ficha_pdf/<?php echo $row->id;?>/"  class="ficha-item" >Ficha</a>
					
                </div>
				
				<?php 
				
				    $cantidad++;
				?>
				
                <div class="clear"></div>
			
            </li>
        <?php endforeach; ?>
        </ul>
	<br/>	
	<?php echo '<div class="clear" style="padding-right:130px; float:right"> <b> Total:  '.$cantidad.'</b> </div>';?>	

    <?php else: ?>
			<div class="empty-database">
				No hay datos que mostrar...
			</div>
    <?php endif; ?>
    </div>
</div>