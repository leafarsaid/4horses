<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dom {
	
	public $main;
	
	public $title;
	
	static private $instance;
	
	private function __construct(){}
		
    public function toString(){
    	
    	$path = _PROTOCOLO_._SITEURL_;
    	$title = $this->title;
    	
    	$script = "";
    	 
    	$html1 = <<<CMP1
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>{$title}</title>
<head>
<!-- CSS -->
<link href="{$path}calendar/calendar.css" type="text/css" rel="stylesheet">
<!-- link type="text/css" rel="stylesheet" href="{$path}includes/css/base_form.css" -->
<link type="text/css" rel="stylesheet" href="{$path}css/estilo.css">
<link type="text/css" rel="stylesheet" href="{$path}lib/css/cupertino/jquery-ui-1.10.0.custom.min.css">
<link type="text/css" rel="stylesheet" href="{$path}lib/layout/1.1.0/style.css">
<link type="text/css" rel="stylesheet" href="{$path}lib/layout/1.1.0/jquery-ui/jquery-ui.custom.min.css">

<style type="text/css">
    
	.blocoOculto {
        padding: 0 0 20px 0 !important;
        display: inline-block;
    }
    
    .blocoOculto_conteudo{
        margin: 20px 0px 0px 0px !important;
        background_color: red;
    }
    
    .blocoOculto_titulo{
        margin: 20px 0px 0px 0px !important;
	    padding: 0px;
	    height: 25px;
	    line-height: 25px;
	    font-size: 12px;
	    font-weight: bold;
	    vertical-align: middle;
	    border: none!important;
    }
    
    .modulo_conteudo{
    	padding: 20px 20px 20px 20px !important;
    }
    
    .bloco_titulo, .bloco_conteudo, .bloco_acoes{
    	margin: 0px 0px 0px 0px !important;    	
    }
    
    .modulo_titulo{    	
    	min-width: 452px;
    }
    
    .campo {
    	/* padding: 0 0 0 0 !important; */
    }
    
    .painelMenor {
        max-width: 450px;
    }
    .painelMedio {
        max-width: 600px;
    }
    
</style>

<!-- JAVASCRIPT -->

<script type="text/javascript" src="{$path}lib/layout/1.1.0/jquery/jquery.min.js"></script>
<script type="text/javascript" src="{$path}lib/layout/1.1.0/jquery-ui/jquery-ui.custom.min.js"></script>
<script type="text/javascript" src="{$path}lib/layout/1.1.0/jquery/jquery.maskedinput.min.js"></script>

<script type="text/javascript" src="{$path}includes/js/calendar.js"></script>
<script type="text/javascript" src="{$path}includes/js/mascaras.js"></script>
<script type="text/javascript" src="{$path}includes/js/auxiliares.js"></script>
<script language="Javascript" type="text/javascript" src="{$path}includes/js/validacoes.js"></script>
<script language="Javascript">

var width = 800;

$(document).ready(function(){
	if($(window).width() < width){
		$('#menuPrincipal').hide();
      	$('#menu2').show();
	} else{
		$('#menuPrincipal').show();
      	$('#menu2').hide();
	}
});

$(window).resize(function(){
   if($(this).width() < width){
      $('#menuPrincipal').hide();
      $('#menu2').show();
   } else{
   	  $('#menuPrincipal').show();
   	  $('#menu2').hide();
   }
});


{$script}
</script>
</head>
    <body>
		<div id="menu2">			
			<table border="0" width="100%">
				<tr>
					<td><img src="images/logo_sascar_pq.jpg" border="0"></td>
					<td align="right"><img src="http://amazinginstore.com/wp-content/themes/instore/images_new/menuButton.svg" width="30" height="30" border="0"></td>
				</tr>				
			</table>
			<div width="100%" style="height: 4px; background-color: #4A779A;"></div>
        	<div width="100%" style="height: 1px; background-color: #FFFFFF;"></div>
        	<div width="100%" style="height: 4px; background-color: #FCD020;"></div>
        	<div width="100%" style="height: 8px; background-color: #FFFFFF;"></div>
    	</div>
CMP1;
    	
    	$html2 = <<<CMP2
		<script type="text/javascript" src="{$path}lib/layout/1.1.0/bootstrap.js"></script>
	</body>
</html>
CMP2;
    	
    	$return = $html1;
    	
    	$return .= $this->main->toString();
    	
    	$return .= $html2;
    	
    	return $return;
    	
    }
    
    static public function singleton()
    {
    	if (!isset(self::$instance)) {
    		$c = __CLASS__;
    		self::$instance = new $c;
    	}
    		
    	return self::$instance;
    }
    
    public function __clone()
    {
    	trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
/* End of file Dom.php */