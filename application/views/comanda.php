<!DOCTYPE html>
<html>
  <head>
    <title>Comanda</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" media="screen">
    <link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.css'); ?>" rel="stylesheet">
    <style>
    	body{
    		background-image: url("<?php echo base_url('imgs/bg480x800.png'); ?>");
    		background-position:left top;
    	}
    	.teste{
    		background-color: red;
    		min-height:90px;
    		width: 90px; 
    		height: 90px; 
    		border-width: 7px;
    		border-style:solid;
    		border-color: #ffffff;
    		display: inline-block;
    		margin: 18px;
    	}
    </style>
  </head>
  <body>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="<?php echo base_url('bootstrap/js/bootstrap.min.js'); ?>"></script>
        
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Meu Pedido</a>
          <div class="nav-collapse collapse nav-collapse-fixed-top">
            <p class="navbar-text pull-right">
              Logado como <a href="#" class="navbar-link">RafaelDias</a>
            </p>
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>    
    
    <div class="container">
	    <div class="row-fluid">
	    	<img src="<?php echo base_url('bootstrap/css/bootstrap-responsive.css'); ?>">
	    </div>
    </div>
  </body>
</html>