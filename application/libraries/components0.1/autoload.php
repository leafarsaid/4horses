<?php
function __autoload($classname) {	
	
    $classname = ltrim($classname, '\\');    
    $root = '';
    $path = _SITEDIR_.'builder/application/libraries/components0.1/';
    
    if ($lastnspos = strripos($classname, '\\')) {
    	$classname = substr($classname, $lastnspos + 1);
    }
    
	if ($classname == "Helpful") {
    	$path .= 'helper/';
    }

    $filename = $path . $classname . '.php';
    
    define('BASEPATH','');
    require_once $filename;
}
?>