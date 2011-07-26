<? 

# Here should be a function to set the selected tab 

// Declare the tabs
$md_titulo;

switch($titulo_modulo)
{
	case "home":
		$md_titulo = "Panel Principal";
		break;
					
	case "member": 	
		$md_titulo = "Miembro";
		break;
	
	case "comunity": 	
		$md_titulo = "Comunidad";
		break;
	
	case "confetion": 	
		$md_titulo = "Confesi&oacute;n";
		break;

    case "aports":
        $md_titulo = "Aportes";
        break;

    case "reports":
        $md_titulo = "Reportes";
        break;

    case "admin":
        $md_titulo = "Administraci&oacute;n del Sistema";
		break;

    case "rol":
        $md_titulo = "Roles de Usuario";
		break;
    case "audit":
        $md_titulo = "Auditoria";
		break;

	default:
	 	$md_titulo = "Panel Principal";
		break;

}
?>

<!-- MENU SECTION -->
<div id="menu">
<div class="wrapper">

<div id="myslidemenu" class="jqueryslidemenu">
<ul>
    <li><a href="<?php echo base_url();?>">Inicio</a></li>

<?php


    $rol_id = $this->session->userdata('rol_id');

    $this->myutils->construir_menu($rol_id);

    
?>


</ul>
<br style="clear: left" />
</div>


</div>
</div>

<!-- CONTAINER SECTION -->
<div id="container">
<div class="wrapper">

    <!-- app-body -->
    <div class="<?php echo $tipo_columna;?>">

    <?php if($this->session->flashdata('acceso_denegado') == 1): ?>
    <div id="messageBox">
        <div  class="<?php echo $this->session->flashdata('tipo_mensaje') ?>"><?php echo $this->session->flashdata('mensaje'); ?></div>
    </div>

    <?php endif ;?>

        <h1><?php echo $md_titulo;?></h1>