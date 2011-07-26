<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
$username = array(
	'name'	=> 'log_username',
	'id'	=> 'log_username',
    'class' => 'inputbox',
    'maxlength'  => '30'
);

$password = array(
	'name'	=> 'log_password',
	'id'	=> 'log_password',
    'class' => 'inputbox',
    'maxlength'  => '30'
);

$dologin = array (
    'name'  => 'log_dologin',
    'value' => 'Login',
    'class' => 'button'
);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $this->config->item('site_name')?> :: Login</title>

<!-- FAVICON IMAGE -->
<link rel="shortcut icon" href="<?php echo base_url()?>images/favicon.png" type="image/png" />

<!-- CSS FILE -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/login.css" />


</head>

<body>

<div id="wrapper">

    <div class="top"></div>

    
    <div class="login-form">
        <img src="<?php echo base_url();?>images/login-header.png" alt="Login" />
        <?php if(!empty($message)): ?>
            <div id="messageBox">
                <div  class="<?php echo $tipo_mensaje ?>"><?php echo $message; ?></div>
            </div>
        <?php endif ;?>

        <?php echo validation_errors(); ?>
    	<form action="<?php echo base_url()?>home/do_login/" method="post">
    		
            <ul>
            
            	<li>
                    <?php echo form_label('Usuario', $username['id']);?>
                    <?php echo form_input($username)?>
                </li>
                <li>
                    <?php echo form_label('Contrase&ntilde;a', $password['id']);?>
                    <?php echo form_password($password)?>
                </li>

                <hr />
                <li>
                    <?php echo form_submit($dologin);?>

                    <div class="clear"></div>
                </li>
            
            </ul>
            
    	</form>
    </div>

    <div class="bottom"></div>

    <div class=""
</div>

</body>
</html>

