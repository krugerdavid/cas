<?php

function prep_pdf($orientation, $parametros){
	$CI = & get_instance();

	$CI->cezpdf->selectFont(base_url() . '/fonts',array('encoding'=>'utf-8'));

	
	$all = $CI->cezpdf->openObject();
	$CI->cezpdf->saveState();
	$CI->cezpdf->setStrokeColor(0,0,0,1); 
	if($orientation == 'vertical') {
		$CI->cezpdf->addText(30,800,9,$parametros['empresa']);
		$CI->cezpdf->addText(30,790,8,'R.U.C: '.$parametros['ruc']);
		$CI->cezpdf->addText(30,780,8,'Direccion: '.$parametros['direccion']);
		$CI->cezpdf->addText(30,770,8,'Telefono: '.$parametros['telefono']);
		$CI->cezpdf->addText(480,770,8,'User: '.$parametros['usuario']);
		$CI->cezpdf->addText(480,760,8,'Celular: '.$parametros['celular']);
		$CI->cezpdf->addText(480,750,8,'Rol:   '.$parametros['rol']);
		$CI->cezpdf->addText(240,730,12,$parametros['titulo']);
		$CI->cezpdf->line(20,720,578,720);
	    //arriba, abajo, izq, der
		$CI->cezpdf->ezSetMargins(130,70,60,50);
		//columnaInicial, filaInicial, tamanho de fuente
		$CI->cezpdf->ezStartPageNumbers(500,28,8,'','{PAGENUM}',1);
		//columnaInicial, filaInicial, ancho, FilaFinal
		$CI->cezpdf->line(20,40,578,40);
		//columnaInicial, filaInicial, tamanho de fuente         ---->    medidos en pixeles
		$CI->cezpdf->addText(50,32,8,'Fecha/Hora ' . date('m/d/Y h:i:s a'));
		$CI->cezpdf->addText(50,22,8,'Sistema de Administraci�n para Censos');
		$CI->cezpdf->addText(185,32,7,$parametros['reporte']);
	}
	else {
		$CI->cezpdf->addText(30,800,9,$parametros['empresa']);
		$CI->cezpdf->addText(30,790,8,'R.U.C: '.$parametros['ruc']);
		$CI->cezpdf->addText(30,780,8,'Direccion: '.$parametros['direccion']);
		$CI->cezpdf->addText(30,770,8,'Telefono: '.$parametros['telefono']);
		$CI->cezpdf->addText(580,770,8,'Usuario: '.$parametros['usuario']);
		$CI->cezpdf->addText(580,760,8,'Celular: '.$parametros['celular']);
		$CI->cezpdf->addText(580,750,8,'Rol: '.$parametros['rol']);
		$CI->cezpdf->addText(30,730,12,$parametros['titulo']);
		$CI->cezpdf->line(20,720,578,720);
	    //arriba, abajo, izq, der
		$CI->cezpdf->ezSetMargins(130,70,60,50);
		//columnaInicial, filaInicial, tamanho de fuente
		$CI->cezpdf->ezStartPageNumbers(500,28,8,'','{PAGENUM}',1);
		//columnaInicial, filaInicial, ancho, FilaFinal
		$CI->cezpdf->line(20,40,800,40);
		$CI->cezpdf->addText(50,32,8,'Fecha/Hora ' . date('m/d/Y h:i:s a'));
		$CI->cezpdf->addText(50,22,8,'Sistema de Administracion para Censos');
		$CI->cezpdf->addText(185,32,7,$parametros['reporte']);
		
	}
	$CI->cezpdf->restoreState();
	$CI->cezpdf->closeObject();
	$CI->cezpdf->addObject($all,'all');
}

?>