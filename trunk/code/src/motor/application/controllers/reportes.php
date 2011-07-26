<?php

class Reportes extends controller{

	var $info_modulo    = array();
	var $data           = array();  
	var $parametro      = '';
    var $titulo_modulo  = 'reports';
    var $tipo_columna   = 'two_col_wide_right';
	var $datos_usuario  = '';

	var $nombres      = '';
	var $apellidos    = '';
	var $num_doc      = '';
	var $domicilio    = '';
	var $telefono     = '';
	var $sexo  	 	  = '';
	var $fechaD 	  = '';
	var $fechaH 	  = '';
	var $apr_fechaD   = '';
	var $apr_fechaH   = '';
	var $id_cmn 	  = '';
	var $id_cnf       = '';
	var $bautizado    = '';
	var $confirmado   = '';
	var $casado		  = '';
	var $fallecido    = '';
	var $salida       = '';
	var $tipo         = '';
	
	var $data_filtro  = array();   
	
	
	
	
	function Reportes()
	{
		parent::Controller();
		
		//cargar modelos y helpers
		$this->load->helper('url');
		$this->load->helper('pdf');
		$this->load->library('session');
		$this->load->library('cezpdf');
        $this->load->library('pagination');
        $this->load->library('myutils');

		$this->load->helper('html');
		$this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('array');
		
        
		//cargar modelos
		$this->load->model('Comunidad_model');
		$this->load->model('Confesion_model');
		$this->load->model('Pais_model');
		$this->load->model('Departamento_model');
		$this->load->model('Rol_model');
		$this->load->model('Miembro_reporte_model');
		$this->load->model('Usuario_model','usuario_modelo');
		$this->load->model('Miembro_model','miembro_modelo');
		
		 // se declara la informacion sobre el modulo
        $this->info_modulo['titulo_modulo'] = $this->titulo_modulo;
		$this->info_modulo['tipo_columna']  = $this->tipo_columna;

        // compruebo de que el usuario este logeado para acceder a este modulo
        if(empty($this->session->userdata['is_logged_in'])){
			header("Location: ".base_url()."login/");
		}

        $this->parametro = $this->usuario_modelo->obtener_parametros();

         // obtengo los datos del usuario logeado.
		$this->datos_usuario = $this->usuario_modelo->detalles_usuario($this->session->userdata('user_id'));

        if(!$this->usuario_modelo->esta_habilitado($this->datos_usuario->rol_id,$this->uri->segment(1))){
            redirect(base_url()."restringido/");
		}

	}
	
	//recibo por parametro la opcion del menu a  ser llamado
	function index() {	

        $msg['acceso_denegado']    = '1';
        $msg['mensaje']        = 'Debe seleccionar una opcion de Reporte';
        $msg['tipo_mensaje']   = 'request-warning';

        $this->session->set_flashdata($msg);

        //$this->load->view('mensaje',$data);
        header("Location: ".base_url());

		
	}
	
	//-----------------------------reportes html---------------------------------------------------------------
	
	//reporte de comunidades
	function reporte_comunidad(){
		$data['query'] = $this->Comunidad_model->obt_todos();
		$this->mostrar($data, "reporte_comunidad_view");
	}
	
	//reporte de confesiones
	function reporte_confesion(){
		$data['query'] = $this->Confesion_model->obt_todos();
		$this->mostrar($data, "reporte_confesion_view");
	}
	
	//reporte de paises
	function reporte_pais(){
		$data['query'] = $this->Pais_model->obt_todos();
		$this->mostrar($data, "reporte_pais_view");
	}
	
	//reporte de departamentos
	function reporte_depto(){
		$data['query'] = $this->Departamento_model->obt_todos();
		$data['pais_query'] = $this->Pais_model->obt_todos();
		$this->mostrar($data, "reporte_departamento_view");
	}
	
	
	//reporte de roles
	function reporte_rol(){
		$data['query'] = $this->Rol_model->obt_todos();
		$this->mostrar($data, "reporte_rol_view");
	}
	
	//reporte de roles
	function reporte_miembro(){
		$data['query'] = $this->Miembro_reporte_model->obtener_todos();
		$this->mostrar($data, "reporte_miembro_filtro_view");
	}
	
	
	//funcion que llama al vista correspondinte
	function mostrar($data, $reporte_view){
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
		$this->load->view("reportes/".$reporte_view, $data);
		$this->load->view("footer");
	}
	
	//funcion que obtiene los valores en los campos de filtro del formulario
	function obtener_valores(){
		//si estan vacios setear con caracter especial de busqueda sql
		$this->nombres      = ($this->input->post('usr_nombres') != '') ? $this->input->post('usr_nombres') : '%';
		$this->apellidos    = ($this->input->post('usr_apellidos') != '') ? $this->input->post('usr_apellidos') : '%';
		$this->num_doc      = ($this->input->post('usr_doc_num') != '') ? $this->input->post('usr_doc_num') : '%';
		$this->domicilio    = ($this->input->post('usr_domicilio') != '') ? $this->input->post('usr_domicilio') : '%';
		$this->telefono     = ($this->input->post('usr_telefono') != '') ? $this->input->post('usr_telefono') : '%';
		$this->sexo  	 	= ($this->input->post('sexo') != '') ? $this->input->post('sexo') : '%';
		$this->fechaD 	    = $this->input->post('usr_fecha_nacD'); 
		$this->fechaH 	    = $this->input->post('usr_fecha_nacH');
		$this->apr_fechaD 	= $this->input->post('apr_fechaD'); 
		$this->apr_fechaH   = $this->input->post('apr_fechaH');
		$this->id_cmn 	    = $this->input->post('cmn');
		$this->id_cnf       = $this->input->post('cnf');
		$this->bautizado    = $this->input->post('bautizado'); 
		$this->confirmado   = $this->input->post('confirmado');
		$this->casado		= $this->input->post('casado');
		$this->fallecido    = $this->input->post('fallecido');
		$this->salida       = $this->input->post('salida');
		$this->tipo         = $this->input->post('tipo_reporte');
	}
	
	function filtrar_miembro(){
		//obtener valores del forumlario
		$this->obtener_valores();
		//realizar consulta con los filtros obtenidos
		$data['query'] = $this->Miembro_reporte_model->filtrar_miembros($this->nombres, $this->apellidos,
		$this->num_doc, $this->domicilio, $this->telefono, $this->sexo, $this->fechaD, $this->fechaH,
		$this->id_cmn, $this->id_cnf, $this->bautizado, $this->confirmado, $this->casado, $this->fallecido);
		
		//recargar pagina		
		
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
		$this->load->view("reportes/reporte_miembro_filtro_view");
		if ($this->salida == 1){
			$this->load->view("reportes/reporte_miembro_view", $data);
		}else{
			$this->reporte_miembro_pdf($data);
		}		
		$this->load->view("footer");
	}
	
	function filtrar_aporte(){
		//obtener valores del formulario
		$this->obtener_valores();
		//realizar consulta con los filtros obtenidos
	
		
		//recargar pagina		
		
		 // seteo el limite
        $limite = $this->uri->segment(3);
		if(empty($limite)){$limite = 0;}

        $item_x_pagina = $this->config->item('items_x_pagina');

     
       // $this->_crear_paginacion();
		
		
		$this->load->view("header");
		$this->load->view("menu",$this->info_modulo);
		$this->load->view("reportes/reporte_aportes_filtros_view");
		//html
		if ($this->salida == 1){
			if ($this->tipo == 1){
				//resumen
				// obtengo la lista  resumida de aportes
				$data['query'] = $this->Miembro_reporte_model->obtener_miembros_aportes_resumen($this->nombres, $this->apellidos,
				$this->num_doc, $this->id_cmn, $this->id_cnf, $this->apr_fechaD, $this->apr_fechaH);
				
				$this->load->view("reportes/reporte_aportes_view_resumen", $data);
			}
			else{
				//detalle
				// obtengo la lista  detallada de aportes
				$data['query'] = $this->Miembro_reporte_model->obtener_miembros_aportes($this->nombres, $this->apellidos,
				$this->num_doc, $this->id_cmn, $this->id_cnf, $this->apr_fechaD, $this->apr_fechaH);
				
				$this->load->view("reportes/reporte_aporte_view", $data);
			}	
		
		//pdf		
		}else{
		
			if ($this->tipo == 1){
				//resumen
				// obtengo la lista  resumida de aportes
				$data['query'] = $this->Miembro_reporte_model->obtener_miembros_aportes_resumen($this->nombres, $this->apellidos,
				$this->num_doc, $this->id_cmn, $this->id_cnf, $this->apr_fechaD, $this->apr_fechaH);
				
				$this->reporte_aporte_resumen_pdf($data);
			}
			else{
				//detalle
				// obtengo la lista  detallada de aportes
				$data['query'] = $this->Miembro_reporte_model->filtrar_miembros($this->nombres, $this->apellidos,
				$this->num_doc, $this->domicilio, $this->telefono, $this->sexo, $this->fechaD, $this->fechaH,
				$this->id_cmn, $this->id_cnf, $this->bautizado, $this->confirmado, $this->casado, $this->fallecido);
			
				$this->reporte_aporte_pdf($data);
			}	
			
		}		
		$this->load->view("footer");
	}
	
	
	function reporte_aporte(){
		$data='';
		//cargar pagina de filtros
		$this->mostrar($data, "reporte_aportes_filtros_view");
	}
	
	
	//-----------------------------reportes pdf---------------------------------------------------------------
	
	function reporte_comunidad_pdf(){
		
		$data['query'] = $this->Comunidad_model->obt_todos();
		$titulo = "Listado de Comunidades.";
		
		//cargar los datos de la consulta en el arreglo de datos
		foreach ($data['query'] as $row){
			$db_data[]=array('id'=>$row->cmn_id, 'nombre'=>$row->cmn_nombre);
		}
		
		//remplazar nombre de la columnas de las tablas 
		$col_names = array(
			'id' => 'Codigo',
			'nombre' => 'Nombre',
		);
	
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = $titulo;
		$parametros['reporte']   = 'reporte_comunidad';

		prep_pdf('vertical', $parametros); // crear el header y footer del reporte

		//cargar tabla con los datos cargados en los arreglos, obtenidos en la consulta correspondiente
		$this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>500));
		$this->cezpdf->ezStream();
	}
	
	function reporte_confesion_pdf(){
		
		$data['query'] = $this->Confesion_model->obt_todos();
		$titulo = "Listado de Confesiones.";
		
		//cargar los datos de la consulta en el arreglo de datos
		foreach ($data['query'] as $row){
			$db_data[]=array('id'=>$row->cnf_id, 'nombre'=>$row->cnf_nombre);
		}
		
		//remplazar nombre de la columnas de las tablas 
		$col_names = array(
			'id' => 'Codigo',
			'nombre' => 'Nombre',
			);	
	
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = $titulo;
		$parametros['reporte']   = 'reporte_confesion';

		// crear el header y footer del reporte
		prep_pdf('vertical', $parametros); 

		//cargar tabla con los datos cargados en los arreglos, obtenidos en la consulta correspondiente
		$this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>500));
		$this->cezpdf->ezStream();
	}
	
	function reporte_pais_pdf(){
		
		$data['query'] = $this->Pais_model->obt_todos();
		$titulo = "Listado de Paises.";
		
		//cargar los datos de la consulta en el arreglo de datos
		foreach ($data['query'] as $row){
			$db_data[]=array('id'=>$row->pais_id, 'nombre'=>$row->pais_nombre);
		}
		
		//remplazar nombre de la columnas de las tablas 
		$col_names = array(
			'id' => 'Codigo',
			'nombre' => 'Nombre',
			);
	
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = $titulo;
		$parametros['reporte']   = 'reporte_pais';

		 // crear el header y footer del reporte
		prep_pdf('vertical', $parametros);

		//cargar tabla con los datos cargados en los arreglos, obtenidos en la consulta correspondiente
		$this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>500));
		$this->cezpdf->ezStream();
	}
	
	function reporte_depto_pdf(){
		$data['query'] = $this->Departamento_model->obt_todos();
		$titulo = "Listado de Departamentos.";
		
		//cargar los datos de la consulta en el arreglo de datos
		foreach ($data['query'] as $row){
            
			$db_data[]=array('id'=>$row->dto_id, 'nombre'=>$row->dto_nombre, 'pais'=>$row->pais_nombre);
		}
		
		//remplazar nombre de la columnas de las tablas 
		$col_names = array(
			'id' => 'Codigo',
			'nombre' => 'Nombre',
			'pais' => 'Pais',
		);
	
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = $titulo;
		$parametros['reporte']   = 'reporte_depto';

		// crear el header y footer del reporte
		prep_pdf('vertical', $parametros); 

		//cargar tabla con los datos cargados en los arreglos, obtenidos en la consulta correspondiente
		$this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>500));
		$this->cezpdf->ezStream();
	}
	
	function reporte_aporte_pdf($data){
		
		$titulo = "Listado de Aportes de Miembros.";
		
		
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = $titulo;
		$parametros['reporte']   = 'reporte_aporte';

		prep_pdf('vertical', $parametros); // crear el header y footer del reporte
		
		$Total = 0;

        if (!empty($data['query'])){
			//recorrer aportes
            foreach ($data['query'] as $row){
                $this->cezpdf->ezText($row->nombres.' '.$row->apellidos.'  Num. Doc: '.$row->num_doc, 11);
                //linea
                $this->cezpdf->ezText('______________________________________________________________________________________',10);

                //consultar aportes del miembro en el item actual
                $datos_aportes['query'] =$this->Miembro_reporte_model->obtener_aportes($row->id, $this->apr_fechaD, $this->apr_fechaH);

                $subTotal = 0;

                $db_data = array();


                //recorrer detalle de aporte
                if (!empty($datos_aportes['query'])){
                    foreach ($datos_aportes['query'] as $row){
                        //cargar los datos de la consulta en el arreglo de datos
                        $db_data[]=array('fecha'=>date("Y-m-d", strtotime($row->fecha)), 'aporte'=>$row->aporte);
                        $subTotal += $row->aporte;
                    }
                    //asingar nombres a columnas
                    $col_names = array(
                        'fecha' => 'Fecha',
                        'aporte' => 'Aporte',
                    );

                    //imprimir detalle de aportes en formato tabla

                    //linea en blanco
                    $this->cezpdf->ezText(' ', 10);
                    $this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>150));
                    $this->cezpdf->ezText(' ', 6);
                    $this->cezpdf->ezText('SubTotal : '.$subTotal, 11, array('justification' => 'center'));
                    //linea en blanco
                    $this->cezpdf->ezText(' ', 10);

                    $Total += $subTotal;

                }else{
                    //linea en blanco
                    $this->cezpdf->ezText(' ', 10);

                    $this->cezpdf->ezText('   Este miembro no cuenta con  aportes...', 10);

                    //linea en blanco
                    $this->cezpdf->ezText(' ', 10);
                }


                //linea en blanco
                $this->cezpdf->ezText(' ', 10);

            }

            //total del reporte
            $this->cezpdf->ezText('________________________',11, array('justification' => 'right'));
            $this->cezpdf->ezText('Total : '.$Total, 11, array('justification' => 'right'));
             $this->cezpdf->ezStream();
        }else{
            
            $msg['acceso_denegado']    = '1';
            $msg['mensaje']        = 'No existen coincidencias';
            $msg['tipo_mensaje']   = 'request-warning';

            $this->session->set_flashdata($msg);

            //$this->load->view('mensaje',$data);
            header("Location: ".base_url().'/reportes/reporte_aporte');
        }

		
	}
	
	function reporte_aporte_resumen_pdf($data){
		
		$titulo = "Listado de Aportes de Miembros.";
		
		
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = $titulo;
		$parametros['reporte']   = 'reporte_aporte';

		prep_pdf('vertical', $parametros); // crear el header y footer del reporte
		
		$Total = 0;

        if (!empty($data['query'])){
		
			//cargar los datos de la consulta en el arreglo de datos
			foreach ( $data['query'] as $row){
				$Total += $row->monto; 		
				$db_data[]=array(
				'nombres'=>$row->nombres.' '.$row->apellidos.' - '.$row->num_doc, 
				'monto'=>$row->monto);
			}
			//asingar nombres a columnas
			$col_names = array(	
				'nombres' => 'Nombres y Apellidos',
				'monto' => 'Aportes',
			);
			
			$this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>500));
			
			//total del reporte
			$this->cezpdf->ezText('________________________',11, array('justification' => 'right'));
			$this->cezpdf->ezText('Total Aportes : '.$Total, 11, array('justification' => 'right'));
			
			$this->cezpdf->ezStream();
			
               
        }else{
            
            $msg['acceso_denegado']    = '1';
            $msg['mensaje']        = 'No existen coincidencias';
            $msg['tipo_mensaje']   = 'request-warning';

            $this->session->set_flashdata($msg);

            //$this->load->view('mensaje',$data);
            header("Location: ".base_url().'/reportes/reporte_aporte');
        }


	
	}
	
	
	function reporte_rol_pdf(){
	
		$data['query'] =$this->Rol_model->obt_todos();
		$titulo = "Listado de Permisos por Roles.";
		
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    =  $titulo;
		$parametros['reporte']   = 'reporte_rol';
		
		prep_pdf('vertical', $parametros); // crear el header y footer del reporte

		
		$col_names = array(
			'id' => 'Codigo',
			'nombre' => 'Nombre',
		);
		
		//recorrer roles
		foreach ($data['query'] as $row){
			$this->cezpdf->ezText('Rol: '. $row->rol_nombre, 14);
			$this->cezpdf->ezText('_______________________________________________________________________ ',4);
			//$this->cezpdf->ezSetDy(-5);
			$datos_permisos['query'] =$this->Rol_model->obt_permiso_x_roles($row->rol_id);
			//recorrer permisos_x_roles filtrados por rol
			foreach ($datos_permisos['query'] as $row){
				$this->cezpdf->ezText('        - '.$row->prm_nombre, 12);
			}	
			$this->cezpdf->ezText('  ');
			$this->cezpdf->ezSetDy(-5);
		}
		$this->cezpdf->ezStream();
	}
	
	
	//reporte de miembros
	function reporte_miembro_pdf($data){
		
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    = 'Listado de Miembros.';
		$parametros['reporte']   = 'reporte_miembro';
		
		prep_pdf('vertical', $parametros); // crear el header y footer del reporte

		$Total =0 ;
		
		if (!empty($data['query'])){
			
			//cargar los datos de la consulta en el arreglo de datos
			foreach ( $data['query'] as $row){
				$Total ++; 		
				$db_data[]=array(
				'nombres'=>$row->nombres.' '.$row->apellidos, 
				'num_doc'=>$row->num_doc,
				'telefono'=>$row->telefono, 'fecha_nac'=>date("Y-m-d", strtotime($row->fecha_nac)), 'comunidad'=>$row->comunidad, 
				'confesion'=>$row->confesion);
			}
			
			//asingar nombres a columnas
			$col_names = array(	
				'nombres' => 'Nombres y Apellidos',
				'num_doc' => 'Num. Doc.',
				'telefono' => 'Telefono',
				'fecha_nac' => 'Fecha Nac.',
				'comunidad' => 'Comunidad',
				'confesion' => 'Confesion',
			);
			
			$this->cezpdf->ezTable($db_data, $col_names, '', array('width'=>500));
			
			//total del reporte
			$this->cezpdf->ezText('________________________',11, array('justification' => 'right'));
			$this->cezpdf->ezText('Total Miembros : '.$Total, 11, array('justification' => 'right'));
			
			$this->cezpdf->ezStream();
		}else{
			$msg['acceso_denegado'] = '1';
            $msg['mensaje']         = 'No existen coincidencias';
            $msg['tipo_mensaje']    = 'request-warning';

            $this->session->set_flashdata($msg);

            //$this->load->view('mensaje',$data);
            header("Location: ".base_url().'/reportes/reporte_miembro');
		}
		
	}
	
	
		
	function reporte_ficha_pdf($id){
	
		//traer datos del miembro elegido		
		$data['query_miembro']  = $this->Miembro_reporte_model->obtener_miembro($id);
		$data['query_hijo']     = $this->Miembro_reporte_model->obtener_hijos($id);
		$data['query_conyugue'] = $this->Miembro_reporte_model->obtener_conyugue($id);
		$data['query_otro']     = $this->Miembro_reporte_model->obtener_otros($id);
		
		$titulo = "Ficha del Miembro";
		
		$parametros['empresa']   = $this->parametro->par_congregacion;
		$parametros['ruc']       = $this->parametro->par_ruc;
		$parametros['direccion'] = $this->parametro->par_direccion ;
		$parametros['telefono']  = $this->parametro->par_telefono;
		$parametros['usuario']   = $this->datos_usuario->prs_nombres.' '.$this->datos_usuario->prs_apellidos;
		$parametros['celular']   = $this->datos_usuario->prs_telefono;
		$parametros['rol']	     = $this->usuario_modelo->obtener_rol($this->datos_usuario->rol_id);
		$parametros['titulo']    =  $titulo;
		$parametros['reporte']   = 'reporte_ficha_pdf';
		
		prep_pdf('vertical', $parametros); // crear el header y footer del reporte

		//linea en blanco
		$this->cezpdf->ezText(' ', 10);
		
		//parametros texto, tamanho de la letra
		$this->cezpdf->ezText('Miembro', 14);
		
		//parametros colInicial, filaInicial, colFinal, filaFinal
		$this->cezpdf->line(35,680,520,680);
		
		//linea en blanco
		$this->cezpdf->ezText(' ', 8);
		
		if ($data['query_miembro'] != 'VACIO'){ 
			foreach ($data['query_miembro'] as $row){
				
					
				$db_data_principal[]=array(
				'nombre_titulo'=>'Nombres:', 
				'nombres'=>$row->nombres, 
				'apellido_titulo'=>'Apellidos:', 
				'apellidos'=>$row->apellidos, 
				'num_doc_titulo'=>'Num. Doc.:', 
				'num_doc'=>$row->num_doc);
				
				$db_data_dir_tel[]=array(
				'direccion_titulo'=>'Direccion:', 
				'direccion'=>$row->direccion, 
				'telefono_titulo'=>'Telefono:', 
				'telefono'=>$row->telefono);
				
				$db_data_sex_bautizado[]=array(
				'bautizado_titulo'=>'Bautizado:', 
				'bautizado'=>($row->bautizado == 'S') ? 'SI' : 'NO', 
				'confiramdo_titulo'=>'Confirmado:', 
				'confirmado'=>($row->confirmado == 'S') ? 'SI' : 'NO', 
				'casado_titulo'=>'Casado:', 
				'casado'=>($row->casado == 'S') ? 'SI' : 'NO', 
				);
				
				
			}
			
		
			//linea en blanco
			$this->cezpdf->ezText(' ', 10);
			
			//crear tabla datos principales
			$this->cezpdf->ezTable($db_data_principal, ' ', '', array('width'=>400, 'showHeadings'=>0,  'showLines'=>0, 'shaded'=> 0, 'fontSize' => 11,
			'cols'=>array('nombre_titulo'=>array('justification'=>'right'),'apellido_titulo'=>array('justification'=>'right'), 
			'num_doc_titulo'=>array('justification'=>'right'))
			));
		
		
			//crear tabla datos secundarios
			$this->cezpdf->ezTable($db_data_dir_tel, ' ', '', array('width'=>410, 'showHeadings'=>0,  'showLines'=>0, 'shaded'=> 0, 'fontSize' => 11,
			'cols'=>array('direccion_titulo'=>array('justification'=>'right'),'telefono_titulo'=>array('justification'=>'right'))
			));
			
			//crear tabla datos secundarios
			$this->cezpdf->ezTable($db_data_sex_bautizado, ' ', '', array('width'=>390, 'showHeadings'=>0,  'showLines'=>0, 'shaded'=> 0, 'fontSize' => 11,
			'cols'=>array('bautizado_titulo'=>array('justification'=>'right'),
			'confiramdo_titulo'=>array('justification'=>'right'), 'casado_titulo'=>array('justification'=>'right'))
				));
				
			//linea en blanco
			$this->cezpdf->ezText(' ', 10);
			$this->cezpdf->ezText('                   Fecha de Nacimiento: '. date("Y-m-d", strtotime($row->fecha_nac)), 11);
			
			//linea en blanco
			$this->cezpdf->ezText(' ', 10);			
			$this->cezpdf->ezText('                   Confesión:   '. ($row->confesion), 11);
			
			//linea en blanco
			$this->cezpdf->ezText(' ', 10);			
			$this->cezpdf->ezText('                   Comunidad: '. ($row->comunidad), 11);
			
		}else{
			$this->cezpdf->ezText('no existe miembro...', 10, array('justification' => 'center'));
		}					
		
		//linea en blanco
		$this->cezpdf->ezText(' ', 5);
		
		$this->cezpdf->ezText('Cónyugue', 14);
		
		$this->cezpdf->ezText('_________________________________________________________________', 5);
		
		//linea en blanco
		$this->cezpdf->ezText(' ', 5);
		
		if ($data['query_conyugue'] != 'VACIO'){
			foreach ($data['query_conyugue'] as $row){
				//linea en blanco
				$this->cezpdf->ezText(' ', 4);
				
				$this->cezpdf->ezText('Nombres  :  '. $row->nombres, 11);
				//linea en blanco
				$this->cezpdf->ezText(' ', 4);
				
				$this->cezpdf->ezText('Apellidos  :  '. $row->apellidos,11);
				//linea en blanco
				$this->cezpdf->ezText(' ', 4);
				
				$this->cezpdf->ezText('Num. Doc :  '. $row->num_doc, 11);
				//linea en blanco
				$this->cezpdf->ezText(' ', 4);
			}	
		}else{
				$this->cezpdf->ezText('El miembro no tiene conyugue...', 10, array('justification' => 'center'));
		}			
		
		//linea en blanco
		$this->cezpdf->ezText(' ', 5);
		
		
		$this->cezpdf->ezText('Hijo/s', 14);
		
		//linea
		$this->cezpdf->ezText('_________________________________________________________________', 5);
		
		//linea en blanco
		$this->cezpdf->ezText(' ', 5);
		
		if ($data['query_hijo'] != 'VACIO'){
			foreach ($data['query_hijo'] as $row){
				$db_data_hijos[]=array('nombre'=>$row->nombres, 'apellido'=>$row->apellidos, 'ci'=>$row->num_doc);
			}
			
			$col_names = array(
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'ci' => 'Num. Doc',);
			
			//linea en blanco
			$this->cezpdf->ezText(' ', 10);
			
			//crear tabla de hijos
			$this->cezpdf->ezTable($db_data_hijos, $col_names, '', array('width'=>250, 'showLines'=>1, 'shaded'=> 0));
		}else{
			$this->cezpdf->ezText('El miembro no tiene hijo/s...', 10, array('justification' => 'center'));
		}					
					
		//linea en blanco
		$this->cezpdf->ezText(' ', 10);
		
		$this->cezpdf->ezText('Otro/s', 14);
		
		$this->cezpdf->ezText('_________________________________________________________________', 5);
		
		//linea en blanco
		$this->cezpdf->ezText(' ', 5);
		
		if ($data['query_otro'] != 'VACIO'){
		
			foreach ($data['query_otro'] as $row){
				$db_data_otros[]=array('nombre'=>$row->nombres, 'apellido'=>$row->apellidos, 'ci'=>$row->num_doc);
			}
			
			$col_names = array(
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'ci' => 'Num. Doc',);
			
			//linea en blanco
			$this->cezpdf->ezText(' ', 10);
			
			$this->cezpdf->ezTable($db_data_otros, $col_names, '', array('width'=>250, 'showLines'=>1, 'shaded'=> 1));
			
		}else{
				//linea en blanco
			    $this->cezpdf->ezText(' ', 10);
				$this->cezpdf->ezText('El miembro no tiene otros...', 10, array('justification' => 'center'));
		}
	
		$this->cezpdf->ezStream();
	}

	
	//----------funciones especiales
	
	function _crear_paginacion()
    {

     // configuro el paginador
		$config['base_url']     = base_url().'reportes/reporte_aporte_view/';
		$config['total_rows']   = $this->miembro_modelo->total_aportes();
		$config['per_page']     = $this->config->item('items_x_pagina');

        $config['num_links'] = 5;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class=active>';
        $config['cur_tag_close'] = '</li>';

        $config['first_link'] = 'Inicio';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class=previous>';
        $config['prev_tag_close'] = '</li>';

        $config['last_link'] = 'Ultimo';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class=next>';
        $config['next_tag_close'] = '</li>';

		$this->pagination->initialize($config);

    }
	


}
/* End of reporte_confesion.php */
/* Location: ./motor/controllers/reporte_confesion.php */

?>
