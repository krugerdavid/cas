<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->config->item('site_name')?></title>

<!-- FAVICON IMAGE --> 
<link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.png" type="image/png" />

<!-- CSS FILE --> 
<link rel="stylesheet" href="<?php echo base_url()?>css/default.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>css/jquery.autocomplete.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>css/ui-lightness/jquery-ui-1.7.2.custom.css" type="text/css" />



<!-- JAVASCRIPT FILES -->
<script language="javascript">
<!--
var base_url = "<?php echo base_url();?>";
var server_year = "<?php echo date("Y");?>";
var server_month = "<?php echo date("m");?>";
var server_day = "<?php echo date("d");?>";
var server_mayor_edad = "<?php echo date("Y-m-d",strtotime("-18 years"));?>";
var fecha_server = server_year + "-" + server_month + "-" + server_day;
//-->
</script>
<script language="javascript" src="<?php echo base_url()?>js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/jquery-ui-1.7.2.custom.min.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/jqueryslidemenu.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/jquery.alphanumeric.pack.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/jquery.maskedinput-1.2.2.min.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/jautocomplete.js"></script>
<script language="javascript" src="<?php echo base_url()?>js/global.js"></script>
<!--[if lt IE 6.]>
<script defer type="text/javascript" src="<?php echo base_url()?>js/pngfix.js"></script>
<![endif]-->

<!-- Script for transparent pngs on IE7 -->
<!--[if lt IE 7]>
<script defer type="text/javascript" src="<?php echo base_url()?>js/pngfixie7.js"></script>
<![endif]-->
</head>

<body>

<!-- HEADER SECTION -->
<div id="header">
    <div class="wrapper_visible wrapper">
        <a id="app-logo" href="<?php echo base_url(); ?>">
            <img title="Volver al panel principal" alt="Volver al panel principal" src="<?php echo base_url(); ?>images/app-logo.png"/>
        </a>

        <?php

        if($this->session->userdata('is_logged_in') == 1):
            $datos = $this->usuario_modelo->detalles_usuario($this->session->userdata('user_id'));
		?>
        <ul id="login">
            <li class="welcome-message"><span>Bienvenido <?php echo $datos->prs_nombres; echo ' '; echo $datos->prs_apellidos; ?> &nbsp;|</span></li>
            <li class="logout-app"><span><a href="javascript:logout()">Logout</a></span></li>
        </ul>
        <?php endif; ?>
    </div>
</div>
<!-- END HEADER -->
