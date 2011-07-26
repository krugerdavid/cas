<!--comunidad panel-->
<div class="comunity-panel">
    <?php if($this->session->flashdata('hay_mensaje') == 1): ?>
        <div id="messageBox">
            <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>

    <?php endif ;?>

	 <!-- opcion que convierte el  reporte en formato pdf-->
     <div class="section-header">
        <div class="module-options">     
		  <form id="form2" name="form_depto_imprimir" method="post" action="<?php echo  base_url() ?>reportes/reporte_depto_pdf/">
                <button type="submit">Imprimir</button>
            </form>
        </div>
        <div class="clear"></div>
    </div>
	
	
    <div class="comunity-list">

    <?php if(!empty($query)):?>

        <!-- HEADER OF THE COMUNITY LIST -->
        <div class="header">
		    <div class="col-id">Codigo</div>
			<div class="col-short-desrip">Nombre</div>
			<div class="col-short-desrip">Pais</div>
            <div class="clear"></div>
        </div>

        <ul class="list-row">
        <!-- LIST ALL THE COMUNITIES -->
        <?php foreach ($query as $row):?>
            <li>
			    <div class="col-id"><?=$row->dto_id;?></div>
				<div class="col-short-desrip"><?=$row->dto_nombre;?></div>					
				<div class="col-short-desrip"><?=$row->pais_nombre;?></div>					
                <div class="clear"></div>
            </li>
        <?php endforeach; ?>
        </ul>

    <?php else: ?>
			<div class="empty-database">
				No hay datos que mostrar...
			</div>
    <?php endif; ?>
    </div>
</div>